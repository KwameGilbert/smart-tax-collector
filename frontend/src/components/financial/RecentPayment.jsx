// src/components/RecentPayments.jsx
import React, { useEffect, useState } from "react";
import axios from "axios";
import { FaEdit, FaEye, FaTrash } from "react-icons/fa";
import { Link } from "react-router-dom";
import Swal from "sweetalert2";

const RecentPayments = () => {
  const [payments, setPayments] = useState([]);
  const [search, setSearch] = useState("");
  const [currentPage, setCurrentPage] = useState(1);
  const itemsPerPage = 5;

  useEffect(() => {
    axios.get("/assets/data/recentpayment.json")
      .then(response => setPayments(response.data))
      .catch(error => console.error("Error fetching data:", error));
  }, []);

  const handleDelete = (id) => {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
        setPayments(payments.filter(payment => payment.id !== id));
        Swal.fire("Deleted!", "Payment has been deleted.", "success");
      }
    });
  };

  const filteredPayments = payments.filter(payment =>
    payment.business_name.toLowerCase().includes(search.toLowerCase()) ||
    payment.tax_type.toLowerCase().includes(search.toLowerCase())
  );

  const paginatedPayments = filteredPayments.slice(
    (currentPage - 1) * itemsPerPage,
    currentPage * itemsPerPage
  );

  return (
    <div className="bg-white rounded-lg shadow p-6 mb-5">
      <div className="mb-4 flex items-center justify-between">
        <div>
          <h2 className="text-xl font-semibold">Recent Collections</h2>
          <p className="text-gray-500 text-sm">Latest tax payments received</p>
        </div>
        <input
          type="text"
          placeholder="Search payments..."
          value={search}
          onChange={(e) => setSearch(e.target.value)}
          className="border px-3 py-2 rounded-md w-64 shadow-sm focus:outline-none focus:ring focus:border-blue-300"
        />
      </div>

      <div className="overflow-x-auto">
        <table className="min-w-full divide-y divide-gray-200">
          <thead>
            <tr>
              <th className="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Business</th>
              <th className="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tax Type</th>
              <th className="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
              <th className="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
              <th className="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Method</th>
              <th className="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
          </thead>
          <tbody className="bg-white divide-y divide-gray-200">
            {paginatedPayments.map(payment => (
              <tr key={payment.id}>
                <td className="px-4 py-4 text-sm whitespace-nowrap">{payment.business_name}</td>
                <td className="px-4 py-4 text-sm whitespace-nowrap">{payment.tax_type}</td>
                <td className="px-4 py-4 text-sm whitespace-nowrap">{payment.payment_date}</td>
                <td className="px-4 py-4 text-sm whitespace-nowrap">GHS {payment.amount_paid.toFixed(2)}</td>
                <td className="px-4 text-sm py-4 whitespace-nowrap">
                  <span className={`px-2 py-1 text-xs rounded-full font-medium ${
                    payment.payment_method === 'momo' ? 'bg-yellow-100 text-yellow-800' :
                    payment.payment_method === 'card' ? 'bg-blue-100 text-blue-800' :
                    'bg-green-100 text-green-800'
                  }`}>
                    {payment.payment_method_label}
                  </span>
                </td>
                <td className="px-4 py-4 whitespace-nowrap flex items-center gap-3">
                  <Link to={`/finance/recent-payments/${payment.id}`}><FaEye className="text-blue-600 text-sm hover:text-blue-800 cursor-pointer" /></Link>
                  <Link to={`/edit/${payment.id}`}><FaEdit className="text-green-600 text-sm hover:text-green-800 cursor-pointer" /></Link>
                  <FaTrash
                    className="text-red-600 text-sm hover:text-red-800 cursor-pointer"
                    onClick={() => handleDelete(payment.id)}
                  />
                </td>
              </tr>
            ))}
            {paginatedPayments.length === 0 && (
              <tr><td colSpan="6" className="text-center py-4 text-gray-500">No payments found.</td></tr>
            )}
          </tbody>
        </table>
      </div>

      <div className="mt-4 flex justify-between">
        <div className="text-sm text-gray-600">
          Page {currentPage} of {Math.ceil(filteredPayments.length / itemsPerPage)}
        </div>
        <div className="flex gap-2">
          <button
            className="px-3 py-1 bg-gray-100 rounded hover:bg-gray-200"
            onClick={() => setCurrentPage(p => Math.max(p - 1, 1))}
          >Previous</button>
          <button
            className="px-3 py-1 bg-gray-100 rounded hover:bg-gray-200"
            onClick={() => setCurrentPage(p => p + 1)}
            disabled={currentPage === Math.ceil(filteredPayments.length / itemsPerPage)}
          >Next</button>
        </div>
      </div>
    </div>
  );
};

export default RecentPayments;
