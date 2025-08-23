import React, { useEffect, useState } from "react";
import axios from "axios";
import Swal from "sweetalert2";
import { useNavigate } from "react-router-dom";
import { Eye, Edit, Trash2 } from "lucide-react";

const PaymentsTable = () => {
  const [payments, setPayments] = useState([]);
  const [loading, setLoading] = useState(true);
  const navigate = useNavigate();

  useEffect(() => {
    axios
      .get("/assets/data/paymentTable.json")
      .then((res) => {
        setPayments(res.data);
        setLoading(false);
      })
      .catch((err) => {
        console.error("Failed to fetch data", err);
        setLoading(false);
      });
  }, []);

  // const handleDelete = (receiptNo) => {
  //   Swal.fire({
  //     title: "Are you sure?",
  //     text: `You are about to delete ${receiptNo}`,
  //     icon: "warning",
  //     showCancelButton: true,
  //     confirmButtonColor: "#e3342f",
  //     confirmButtonText: "Yes, delete it!",
  //   }).then((result) => {
  //     if (result.isConfirmed) {
  //       setPayments(payments.filter((item) => item.receiptNo !== receiptNo));
  //       Swal.fire("Deleted!", "Payment has been deleted.", "success");
  //     }
  //   });
  // };

  if (loading) return <p className="p-6">Loading payments...</p>;

  return (
    <div className="py-6">
      <div className="bg-white rounded shadow overflow-auto">
        <table className="min-w-full text-sm divide-y divide-gray-200">
          <thead className="bg-gray-100">
            <tr>
              <th className="px-3 py-3 text-left">Receipt No.</th>
              <th className="px-3 py-3 text-left">Business</th>
              <th className="px-3 py-3 text-left">Tax Type</th>
              <th className="px-3 py-3 text-left">Amount</th>
              <th className="px-3 py-3 text-left">Date</th>
              <th className="px-3 py-3 text-left">Method</th>
              <th className="px-3 py-3 text-left">Collector</th>
              <th className="px-3 py-3 text-left">Status</th>
              <th className="px-3 py-3 text-left">Actions</th>
            </tr>
          </thead>
          <tbody className="bg-white divide-y divide-gray-200">
            {payments.map((item, index) => (
              <tr key={index} className="hover:bg-gray-100">
                <td className="px-3 py-4 text-left text-sm whitespace-nowrap">
                  {item.receiptNo}
                </td>
                <td className="px-3 py-4 text-left text-sm whitespace-nowrap">
                  {item.business}
                </td>
                <td className="px-3 py-4 text-left text-sm whitespace-nowrap">
                  {item.taxType}
                </td>
                <td className="px-3 py-4 text-left text-sm whitespace-nowrap">
                  {item.amount}
                </td>
                <td className="px-3 py-4 text-left text-sm whitespace-nowrap">
                  {item.date}
                </td>
                <td className="px-3 py-4 text-left text-sm whitespace-nowrap">
                  {item.method}
                </td>
                <td className="px-3 py-4 text-left text-sm whitespace-nowrap">
                  {item.collector}
                </td>
                <td
                  className={`px-3 py-4 text-left text-sm whitespace-nowrap ${
                    item.status === "Confirmed"
                      ? "text-green-700"
                      : "text-yellow-600"
                  }`}
                >
                  {item.status}
                </td>
                <td className="px-6 py-4 flex items-center gap-3">
                  <Eye
                    onClick={() => navigate(`/payments/view/${item.receiptNo}`)}
                    className="cursor-pointer text-blue-600 hover:scale-110"
                    size={18}
                  />
                  {/* <Edit
                    onClick={() => navigate(`/payments/edit/${item.receiptNo}`)}
                    className="cursor-pointer text-yellow-500 hover:scale-110"
                    size={18}
                  /> */}
                  {/* <Trash2
                    onClick={() => handleDelete(item.receiptNo)}
                    className="cursor-pointer text-red-500 hover:scale-110"
                    size={18}
                  /> */}
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </div>
  );
};

export default PaymentsTable;
