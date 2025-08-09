import React, { useState, useEffect } from "react";
import axios from "axios";
import { Link } from "react-router-dom";
import {
  RiEyeLine,
  RiPencilLine,
  RiDeleteBin6Line,
  RiCloseCircleLine,
  RiCheckboxCircleLine,
  RiSearchLine,
  RiAddLine,
} from "react-icons/ri";
import Swal from "sweetalert2";

const BusinessTable = () => {
  const [businesses, setBusinesses] = useState([]);
  const [search, setSearch] = useState("");
  //const [modal, setModal] = useState({ open: false, id: null, action: "" });
  const [page, setPage] = useState(1);
  const perPage = 10;
  

  useEffect(() => {
    axios
      .get("/assets/data/businessregistry.json")
      .then((res) => setBusinesses(res.data))
      .catch((err) => console.error("Error loading business data:", err));
  }, []);

  const filtered = businesses.filter(
    (b) =>
      b.name.toLowerCase().includes(search.toLowerCase()) ||
      b.owner_name.toLowerCase().includes(search.toLowerCase())
  );
  const totalPages = Math.ceil(filtered.length / perPage);
  const paginated = filtered.slice((page - 1) * perPage, page * perPage);

  const handleDelete = (id) => {
    Swal.fire({
      title: "Delete Business?",
      text: "This action cannot be undone.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
        setBusinesses((prev) => prev.filter((b) => b.id !== id));
        Swal.fire("Deleted!", "Business has been removed.", "success");
      }
    });
  };


  return (
    <div className="">
      <div className="p-4 md:p-6 bg-gray-100">
        <div className="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
          <div>
            <h1 className="text-2xl font-bold">Business Registry</h1>
            <p className="text-gray-600">
              Manage registered businesses and their tax obligations
            </p>
          </div>
          <div className="flex flex-col sm:flex-row gap-3">
            <div className="relative">
              <input
                type="text"
                placeholder="Search businesses..."
                value={search}
                onChange={(e) => {
                  setSearch(e.target.value);
                  setPage(1);
                }}
                className="pl-10 pr-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
              />
              <div className="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <RiSearchLine className="text-gray-500" />
              </div>
            </div>
            <Link
              to="/finance/business-registry-forms"
              className="flex items-center gap-2 bg-blue-900 hover:bg-blue-800 text-white px-4 py-2 rounded-md shadow-sm"
            >
              <RiAddLine /> Register Business
            </Link>
          </div>
        </div>

        <div className="bg-white rounded-lg shadow overflow-x-auto">
          <table className="min-w-full divide-y divide-gray-200">
            <thead className="bg-gray-50 text-xs text-gray-500 uppercase">
              <tr>
                <th className="px-4 py-3 text-left">Business Name</th>
                <th className="px-4 py-3 text-left">Owner</th>
                <th className="px-4 py-3 text-left">Contact</th>
                <th className="px-4 py-3 text-left">Location</th>
                <th className="px-4 py-3 text-left">Type</th>
                <th className="px-4 py-3 text-left">Reg. Date</th>
                <th className="px-4 py-3 text-left">Status</th>
                <th className="px-4 py-3 text-left">Actions</th>
              </tr>
            </thead>
            <tbody className="bg-white divide-y divide-gray-100">
              {paginated.map((b) => (
                <tr key={b.id}>
                  <td className="px-4 py-3 text-sm">{b.name}</td>
                  <td className="px-4 py-3 text-sm">{b.owner_name}</td>
                  <td className="px-4 py-3 text-sm">{b.contact}</td>
                  <td className="px-4 py-3 text-sm">{b.location}</td>
                  <td className="px-4 py-3 text-sm">{b.business_type}</td>
                  <td className="px-4 py-3 text-sm">
                    {new Date(b.registration_date).toLocaleDateString()}
                  </td>
                  <td className="px-4 py-3">
                    <span
                      className={`px-2 py-1 text-xs font-semibold rounded-full ${
                        b.status === "active"
                          ? "bg-green-100 text-green-800"
                          : "bg-red-100 text-red-800"
                      }`}
                    >
                      {b.status}
                    </span>
                  </td>
                  <td className="px-4 py-4 whitespace-nowrap text-right flex items-center gap-2 justify-end">
                    <Link
                      to={`view-registered-business/${b.id}`}
                      className="text-lg text-blue-600 hover:text-blue-800"
                    >
                      <RiEyeLine />
                    </Link>
                    <Link
                      to={`/businesses/edit/${b.id}`}
                      className="text-lg text-indigo-600 hover:text-indigo-800"
                    >
                      <RiPencilLine />
                    </Link>
                    <button
                      onClick={() => handleDelete(b.id)}
                      className="text-lg text-red-600 hover:text-gray-800"
                    >
                      <RiDeleteBin6Line />
                    </button>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>

        {/* pagination */}
        <div className="mt-4 flex justify-end space-x-2 text-sm">
          <button
            disabled={page === 1}
            onClick={() => setPage((p) => p - 1)}
            className="px-3 py-1 border rounded disabled:opacity-50"
          >
            Prev
          </button>
          {Array.from({ length: totalPages }, (_, i) => (
            <button
              key={i}
              onClick={() => setPage(i + 1)}
              className={`px-3 py-1 border rounded ${
                page === i + 1 ? "bg-blue-600 text-white" : "hover:bg-gray-200"
              }`}
            >
              {i + 1}
            </button>
          ))}
          <button
            disabled={page === totalPages}
            onClick={() => setPage((p) => p + 1)}
            className="px-3 py-1 border rounded disabled:opacity-50"
          >
            Next
          </button>
        </div>
      </div>
    </div>
  );
};

export default BusinessTable;
