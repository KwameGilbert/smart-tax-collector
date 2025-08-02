import React, { useEffect, useState } from "react";
import axios from "axios";
import Swal from "sweetalert2";
import { Eye, Pencil, Trash2, Smartphone, Banknote, CreditCard } from "lucide-react";
import { Link } from "react-router-dom";

const paymentStyles = {
  "Cash": { bg: "bg-green-100", text: "text-green-700", icon: <Banknote className="w-4 h-4 mr-1" /> },
  "Mobile Money": { bg: "bg-blue-100", text: "text-blue-700", icon: <Smartphone className="w-4 h-4 mr-1" /> },
  "Card": { bg: "bg-purple-100", text: "text-purple-700", icon: <CreditCard className="w-4 h-4 mr-1" /> },
};

const RecentCollections = () => {
  const [collections, setCollections] = useState([]);
  const [currentPage, setCurrentPage] = useState(1);
  const itemsPerPage = 10;

  useEffect(() => {
    axios.get("/assets/data/RecentCollectoions.json").then((res) => {
      setCollections(res.data);
    });
  }, []);

  const formatCurrency = (amount) =>
    new Intl.NumberFormat("en-GH", {
      style: "currency",
      currency: "GHS",
    }).format(amount);

  const timeAgo = (dateString) => {
    const diff = Date.now() - new Date(dateString).getTime();
    const mins = Math.floor(diff / (1000 * 60));
    if (mins < 60) return `${mins} minutes ago`;
    const hrs = Math.floor(mins / 60);
    if (hrs < 24) return `${hrs} hours ago`;
    const days = Math.floor(hrs / 24);
    return `${days} days ago`;
  };

  const handleDelete = (id) => {
    Swal.fire({
      title: "Are you sure?",
      text: "You’re about to delete this collection!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
        const updatedCollections = collections.filter((item) => item.id !== id);
        setCollections(updatedCollections);
        Swal.fire("Deleted!", "The collection has been deleted.", "success");

        // Adjust pagination if needed
        const lastPage = Math.ceil(updatedCollections.length / itemsPerPage);
        if (currentPage > lastPage) setCurrentPage(lastPage);
      }
    });
  };

  // Pagination logic
  const totalPages = Math.ceil(collections.length / itemsPerPage);
  const indexOfLast = currentPage * itemsPerPage;
  const indexOfFirst = indexOfLast - itemsPerPage;
  const currentItems = collections.slice(indexOfFirst, indexOfLast);

  const handlePrev = () => {
    if (currentPage > 1) setCurrentPage(currentPage - 1);
  };

  const handleNext = () => {
    if (currentPage < totalPages) setCurrentPage(currentPage + 1);
  };

  return (
    <div className="mt-8">
      <div className="flex items-center justify-between mb-4">
        <h2 className="text-lg font-semibold text-gray-800">Recent Collections</h2>
        <Link to="/collections" className="text-blue-600 hover:text-blue-700 font-medium text-sm">
          View All
        </Link>
      </div>
      <div className="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
        <div className="overflow-x-auto">
          <table className="min-w-full divide-y divide-gray-200 text-sm">
            <thead className="bg-gray-50">
              <tr>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Receipt ID</th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Business</th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tax Type</th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Payment</th>
                <th className="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
              </tr>
            </thead>
            <tbody className="bg-white divide-y divide-gray-200">
              {currentItems.map((collection) => {
                const { bg, text, icon } = paymentStyles[collection.payment_method] || {};
                return (
                  <tr key={collection.id}>
                    <td className="px-6 py-4 font-medium text-gray-900">{collection.id}</td>
                    <td className="px-6 py-4 text-gray-900">{collection.business_name}</td>
                    <td className="px-6 py-4 text-gray-500">{collection.tax_type}</td>
                    <td className="px-6 py-4 font-semibold text-gray-900">
                      {formatCurrency(collection.amount)}
                    </td>
                    <td className="px-6 py-4 text-gray-500">{timeAgo(collection.date)}</td>
                    <td className="px-6 py-4">
                      <div className={`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${bg} ${text}`}>
                        {icon}
                        {collection.payment_method}
                      </div>
                    </td>
                    <td className="px-6 py-4 flex gap-3 justify-end">
                      <Link to={`/view/${collection.id}`}>
                        <Eye className="w-4 h-4 text-blue-600 hover:text-blue-800 cursor-pointer" />
                      </Link>
                      <Link to={`/edit/${collection.id}`}>
                        <Pencil className="w-4 h-4 text-green-600 hover:text-green-800 cursor-pointer" />
                      </Link>
                      <Trash2
                        className="w-4 h-4 text-red-600 hover:text-red-800 cursor-pointer"
                        onClick={() => handleDelete(collection.id)}
                      />
                    </td>
                  </tr>
                );
              })}
            </tbody>
          </table>
        </div>

        {/* Pagination Controls */}
        <div className="p-4 flex items-center justify-between border-t bg-gray-50">
          <button
            onClick={handlePrev}
            disabled={currentPage === 1}
            className="px-3 py-1 text-sm text-gray-600 bg-white border rounded disabled:opacity-50"
          >
            Previous
          </button>
          <span className="text-sm text-gray-700">
            Page {currentPage} of {totalPages}
          </span>
          <button
            onClick={handleNext}
            disabled={currentPage === totalPages}
            className="px-3 py-1 text-sm text-gray-600 bg-white border rounded disabled:opacity-50"
          >
            Next
          </button>
        </div>
      </div>
    </div>
  );
};

export default RecentCollections;
