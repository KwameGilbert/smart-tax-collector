import React, { useEffect, useState } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import { Eye, Edit, ArrowLeft, CreditCard, User, ReceiptText, RotateCcw } from 'lucide-react';
import axios from 'axios';

const PaymentsView = () => {
  const { receiptNo } = useParams();
  const navigate = useNavigate();
  const [payment, setPayment] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    axios.get('/assets/data/paymentTable.json')
      .then(res => {
        const found = res.data.find(p => String(p.receiptNo) === String(receiptNo));
        setPayment(found);
        setLoading(false);
      })
      .catch(() => setLoading(false));
  }, [receiptNo]);

  if (loading) {
    return <div className="text-center py-20 text-gray-500 text-lg">Loading payment details...</div>;
  }

  if (!payment) {
    return <div className="text-center py-20 text-red-400 text-lg">Payment not found.</div>;
  }

  return (
    <div className="max-w-5xl mx-auto bg-white rounded-xl shadow p-8 mt-5">
      <div className="flex items-center justify-between mb-6">
        <button onClick={() => navigate(-1)} className="flex items-center gap-2 text-blue-600 hover:underline">
          <ArrowLeft size={18} /> Back
        </button>
        <div className="flex gap-3">
          <button className="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            <Edit size={16} /> Edit
          </button>
          <button className="flex items-center gap-2 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            <RotateCcw size={16} /> Refund
          </button>
        </div>
      </div>
      <h2 className="text-2xl font-bold text-gray-800 mb-2">Payment Details</h2>
      <div className="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4 text-gray-700">
        <div>
          <p className="font-semibold flex items-center gap-1"><User size={16}/> Business:</p>
          <p>{payment.business}</p>
        </div>
        <div>
          <p className="font-semibold flex items-center gap-1"><ReceiptText size={16}/> Receipt No.:</p>
          <p>{payment.receiptNo}</p>
        </div>
        <div>
          <p className="font-semibold">Tax Type:</p>
          <p>{payment.taxType}</p>
        </div>
        <div>
          <p className="font-semibold">Date:</p>
          <p>{payment.date}</p>
        </div>
        <div>
          <p className="font-semibold">Amount:</p>
          <p className="font-bold text-lg">{payment.amount}</p>
        </div>
        <div>
          <p className="font-semibold flex items-center gap-1"><CreditCard size={16}/> Method:</p>
          <span className={`inline-block px-3 py-1 rounded-full text-xs font-semibold ${
            payment.method === 'Card' ? 'bg-blue-100 text-blue-800' :
            payment.method === 'Mobile Money' ? 'bg-yellow-100 text-yellow-800' :
            'bg-green-100 text-green-800'
          }`}>
            {payment.method}
          </span>
        </div>
        <div>
          <p className="font-semibold">Collector:</p>
          <p>{payment.collector}</p>
        </div>
        <div>
          <p className="font-semibold">Status:</p>
          <span className={`inline-block px-3 py-1 rounded-full text-xs font-semibold ${
            payment.status === 'Confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'
          }`}>
            {payment.status}
          </span>
        </div>
      </div>
    </div>
  );
}

export default PaymentsView;