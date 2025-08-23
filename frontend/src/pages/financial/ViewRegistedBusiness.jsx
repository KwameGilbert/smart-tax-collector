import React, { useEffect, useState } from "react";
import { useParams, Link } from "react-router-dom";
import axios from "axios";
import {
  RiArrowLeftLine,
  RiPencilLine,
  RiDeleteBin6Line,
} from "react-icons/ri";


const samplePayments = [
  {
    businessName: "Adwoa Grocery Shop",
    taxType: "Business Operating Permit",
    date: "2025-08-01",
    amount: "GHS 200.00",
    method: "Cash",
  },
  {
    businessName: "Adwoa Grocery Shop",
    taxType: "Signage Fee",
    date: "2025-07-15",
    amount: "GHS 75.00",
    method: "Mobile Money",
  },
  {
    businessName: "Adwoa Grocery Shop",
    taxType: "Market Stall Fee",
    date: "2025-07-01",
    amount: "GHS 50.00",
    method: "Card",
  },
];

const ViewRegisteredBusiness = () => {
  const { id } = useParams();
  const [business, setBusiness] = useState(null);
  // In a real app, payments would be fetched per business. Here, we use sample data for demo.
  const [payments] = useState(samplePayments);

  useEffect(() => {
    axios
      .get("/assets/data/businessregistry.json")
      .then((res) => {
        const found = res.data.find((b) => b.id === parseInt(id));
        setBusiness(found);
      })
      .catch((err) => console.error("Failed to fetch business data", err));
  }, [id]);

  if (!business) {
    return (
      <div className="text-center mt-10 text-gray-600 text-lg">
        Loading business details...
      </div>
    );
  }

  return (
    <div className="">
      <div className="flex justify-between items-center mb-6 max-w-6xl mx-auto">
        <Link
          to="business-registry"
          className="flex items-center text-blue-600 hover:underline"
        >
          <RiArrowLeftLine className="mr-1 text-lg" />
          Back to Registry
        </Link>
        <div className="flex items-center gap-5">
          <Link
            to={`/businesses/edit/${business.id}`}
            className="text-white text-center text-lg bg-blue-700 px-5 py-2 rounded-sm"
          >
            <RiPencilLine className="inline" />
            Edit
          </Link>

          <button className="text-lg text-white flex items-center px-4 py-2 rounded-sm gap-1 bg-red-600">
            <RiDeleteBin6Line />
            Delete
          </button>
        </div>
      </div>

      <div className="max-w-6xl mx-auto py-6 bg-white rounded-xl shadow mt-6">
        <div className="border-b border-gray-200">
          <h1 className="text-2xl font-semibold px-6 pb-6">
            Business Information
          </h1>
        </div>
        <div className="px-6 py-4">
          <h2 className="text-2xl font-bold mb-4 text-gray-800">
            {business.name}
          </h2>

          <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-700">
            <div>
              <p className="font-semibold">Owner Name:</p>
              <p>{business.owner_name}</p>
            </div>
            <div>
              <p className="font-semibold">Contact:</p>
              <p>{business.contact}</p>
            </div>
            <div>
              <p className="font-semibold">Location:</p>
              <p>{business.location}</p>
            </div>
            <div>
              <p className="font-semibold">Business Type:</p>
              <p>{business.business_type}</p>
            </div>
            <div>
              <p className="font-semibold">Registration Date:</p>
              <p>{new Date(business.registration_date).toLocaleDateString()}</p>
            </div>
            <div>
              <p className="font-semibold">Status:</p>
              <span
                className={`inline-block px-3 py-1 text-sm rounded-full ${
                  business.status === "active"
                    ? "bg-green-100 text-green-800"
                    : "bg-red-100 text-red-800"
                }`}
              >
                {business.status}
              </span>
            </div>
          </div>
        </div>
      </div>

      <div className="max-w-6xl mx-auto py-6 bg-white rounded-xl shadow mt-6">
        <div className="border-b border-gray-200">
          <h1 className="text-2xl font-semibold px-6 pb-6">Recent Payments</h1>
        </div>
          <div className="bg-white rounded-lg shadow overflow-x-auto">
            <table className="min-w-full divide-y divide-gray-200">
              <thead className="bg-gray-50 text-xs text-gray-500 uppercase">
                <tr>
                  <th className="px-4 py-3 text-left">Business Name</th>
                  <th className="px-4 py-3 text-left">Tax Type</th>
                  <th className="px-4 py-3 text-left">Date</th>
                  <th className="px-4 py-3 text-left">Amount</th>
                  <th className="px-4 py-3 text-left">Method</th>
                </tr>
              </thead>
              <tbody>
                {payments && payments.length > 0 ? (
                  payments.map((payment, idx) => (
                    <tr key={idx} className="border-b last:border-b-0">
                      <td className="px-4 py-3">{payment.businessName}</td>
                      <td className="px-4 py-3">{payment.taxType}</td>
                      <td className="px-4 py-3">{new Date(payment.date).toLocaleDateString()}</td>
                      <td className="px-4 py-3 font-semibold">{payment.amount}</td>
                      <td className="px-4 py-3">
                        <span className={`rounded px-2 py-1 text-xs font-semibold ${
                          payment.method === "Cash"
                            ? "bg-green-100 text-green-600"
                            : payment.method === "Mobile Money"
                            ? "bg-blue-100 text-blue-600"
                            : "bg-purple-100 text-purple-600"
                        }`}>
                          {payment.method}
                        </span>
                      </td>
                    </tr>
                  ))
                ) : (
                  <tr>
                    <td colSpan={5} className="text-center py-6 text-gray-400">
                      No payment data available.
                    </td>
                  </tr>
                )}
              </tbody>
            </table>
          </div>
        </div>
      </div>
  );
};

export default ViewRegisteredBusiness;
