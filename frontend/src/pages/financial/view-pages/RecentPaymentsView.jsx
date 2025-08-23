import React, { useEffect, useState } from 'react';
import { useParams, Link, useNavigate } from 'react-router-dom';
import { FaEdit, FaArrowLeft, FaMoneyBillWave, FaUndo } from 'react-icons/fa';
import axios from 'axios';

const RecentPaymentsView = () => {
  const { id } = useParams();
  const navigate = useNavigate();
  const [payment, setPayment] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    axios.get('/assets/data/recentpayment.json')
      .then(res => {
        const found = res.data.find(p => String(p.id) === String(id));
        setPayment(found);
        setLoading(false);
      })
      .catch(() => setLoading(false));
  }, [id]);

  if (loading) {
    return <div className="text-center py-20 text-gray-500 text-lg">Loading payment details...</div>;
  }

  if (!payment) {
    return <div className="text-center py-20 text-red-400 text-lg">Payment not found.</div>;
  }

  return (
    <div className="max-w-5xl mx-auto bg-white rounded-xl shadow p-8 mt-10">
      <div className="flex items-center justify-between mb-6">
        <button onClick={() => navigate(-1)} className="flex items-center gap-2 text-blue-600 hover:underline">
          <FaArrowLeft /> Back
        </button>
        <div className="flex gap-3">
          <Link to={`/edit/${payment.id}`} className="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            <FaEdit /> Edit
          </Link>
          <button className="flex items-center gap-2 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            <FaMoneyBillWave /> Refund
          </button>
        </div>
      </div>
      <h2 className="text-2xl font-bold text-gray-800 mb-2">Payment Details</h2>
      <div className="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4 text-gray-700">
        <div>
          <p className="font-semibold">Business Name:</p>
          <p>{payment.business_name}</p>
        </div>
        <div>
          <p className="font-semibold">Tax Type:</p>
          <p>{payment.tax_type}</p>
        </div>
        <div>
          <p className="font-semibold">Date:</p>
          <p>{payment.payment_date}</p>
        </div>
        <div>
          <p className="font-semibold">Amount Paid:</p>
          <p className="font-bold text-lg">GHS {payment.amount_paid.toFixed(2)}</p>
        </div>
        <div>
          <p className="font-semibold">Payment Method:</p>
          <span className={`inline-block px-3 py-1 rounded-full text-xs font-semibold ${
            payment.payment_method === 'momo' ? 'bg-yellow-100 text-yellow-800' :
            payment.payment_method === 'card' ? 'bg-blue-100 text-blue-800' :
            'bg-green-100 text-green-800'
          }`}>
            {payment.payment_method_label}
          </span>
        </div>
        <div>
          <p className="font-semibold">Receipt No.:</p>
          <p>{payment.receipt_no || '-'}</p>
        </div>
        <div className="sm:col-span-2">
          <p className="font-semibold">Collector:</p>
          <p>{payment.collector_name || '-'}</p>
        </div>
      </div>
    </div>
  );
}

export default RecentPaymentsView;