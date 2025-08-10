import React, { useState } from "react";
import {
  FaSearch,
  FaFilter,
  FaFileExport,
  FaPlus,
  FaEdit,
  FaTrash,
  FaInfoCircle,
} from "react-icons/fa";
import { Button } from "../../ui/button";
import { Input } from "../../ui/input";

const initialTaxTypes = [
  {
    name: "Property Tax",
    code: "PTX001",
    rate: 10,
    description: "Annual property tax",
    category: "Property",
    effective: "2023-01-01",
    exemptions: "None",
    status: "Active",
    date: "2023-01-01",
  },
  {
    name: "Business Permit",
    code: "BPT002",
    rate: 5,
    description: "Business operating permit",
    category: "Business",
    effective: "2023-01-01",
    exemptions: "Startups",
    status: "Inactive",
    date: "2023-02-01",
  },
];
const categories = ["Property", "Business", "Income", "Other"];
const statuses = ["Active", "Inactive"];

export default function TaxTypesTab() {
  const [taxTypes, setTaxTypes] = useState(initialTaxTypes);
  const [search, setSearch] = useState("");
  const [category, setCategory] = useState("");
  const [status, setStatus] = useState("");
  const [showModal, setShowModal] = useState(false);
  const [editIdx, setEditIdx] = useState(null);
  const [form, setForm] = useState({
    name: "",
    code: "",
    rate: "",
    description: "",
    category: "",
    effective: "",
    exemptions: "",
    status: "Active",
  });
  const [auditLog, setAuditLog] = useState([]);

  // Filtered and searched tax types
  const filtered = taxTypes.filter(
    (t) =>
      (!search ||
        t.name.toLowerCase().includes(search.toLowerCase()) ||
        t.code.toLowerCase().includes(search.toLowerCase())) &&
      (!category || t.category === category) &&
      (!status || t.status === status)
  );

  // Handlers
  const openModal = (idx = null) => {
    setEditIdx(idx);
    setForm(
      idx !== null
        ? taxTypes[idx]
        : {
            name: "",
            code: "",
            rate: "",
            description: "",
            category: "",
            effective: "",
            exemptions: "",
            status: "Active",
          }
    );
    setShowModal(true);
  };
  const closeModal = () => setShowModal(false);
  const handleFormChange = (e) =>
    setForm({ ...form, [e.target.name]: e.target.value });
  const saveTaxType = () => {
    let updated;
    if (editIdx !== null) {
      updated = [...taxTypes];
      updated[editIdx] = form;
      setAuditLog([
        ...auditLog,
        { action: "Edit", type: form.name, date: new Date().toISOString() },
      ]);
    } else {
      updated = [...taxTypes, form];
      setAuditLog([
        ...auditLog,
        { action: "Add", type: form.name, date: new Date().toISOString() },
      ]);
    }
    setTaxTypes(updated);
    closeModal();
  };
  const deleteTaxType = (idx) => {
    setAuditLog([
      ...auditLog,
      {
        action: "Delete",
        type: taxTypes[idx].name,
        date: new Date().toISOString(),
      },
    ]);
    setTaxTypes(taxTypes.filter((_, i) => i !== idx));
  };

  // Export CSV (simple)
  const exportCSV = () => {
    const rows = [
      Object.keys(form).join(","),
      ...taxTypes.map((t) => Object.values(t).join(",")),
    ];
    const blob = new Blob([rows.join("\n")], { type: "text/csv" });
    const url = URL.createObjectURL(blob);
    const a = document.createElement("a");
    a.href = url;
    a.download = "tax_types.csv";
    a.click();
    URL.revokeObjectURL(url);
  };

  return (
    <div className="p-2 md:p-8">
      <div className="flex items-center justify-between mb-8">
        {/* Breadcrumb */}
        <div className="flex items-center gap-2 text-sm text-blue-700">
          <span>Admin</span> <span className="mx-1">/</span>{" "}
          <span>Settings</span> <span className="mx-1">/</span>{" "}
          <span>Tax Types</span>
        </div>
        {/* export and add tax buttons */}
        <div className="flex items-center gap-10">
          <button
            onClick={exportCSV}
            className="flex items-center gap-2 bg-blue-100 text-blue-700 py-2 px-4 rounded-md"
          >
            <FaFileExport /> Export
          </button>
          <button
            onClick={() => openModal()}
            className="flex items-center gap-2 bg-blue-600 text-white py-2 px-4 rounded-md"
          >
            <FaPlus /> Add Tax Type
          </button>
        </div>
      </div>
      {/* Toolbar */}
      <div className="flex justify-between gap-2 mb-4 items-center bg-white rounded-md py-6 px-4 shadow-sm">
        <div className="flex items-center gap-2 border border-gray-100 px-4 py-2 rounded-md w-full">
          <FaSearch className="text-blue-500" />
          <input
            value={search}
            onChange={(e) => setSearch(e.target.value)}
            placeholder="Search tax types..."
            className="w-full border-0 focus:outline-none"
          />
        </div>
        <div className="flex items-center gap-2 w-full">
          <FaFilter className="text-blue-500" />
          <select
            value={category}
            onChange={(e) => setCategory(e.target.value)}
            className="border rounded px-2 py-1 w-full"
          >
            <option value="">All Categories</option>
            {categories.map((c) => (
              <option key={c}>{c}</option>
            ))}
          </select>
        </div>
        <div className="flex items-center gap-2 w-full">
          <select
            value={status}
            onChange={(e) => setStatus(e.target.value)}
            className="border rounded px-2 py-1 w-full"
          >
            <option value="">All Status</option>
            {statuses.map((s) => (
              <option key={s}>{s}</option>
            ))}
          </select>
        </div>
      </div>
      {/* Table */}
      <div className="overflow-x-auto rounded-lg shadow my-10">
        <table className="min-w-full bg-white">
          <thead className="bg-purple-50">
            <tr>
              <th className="px-3 py-4 text-left">Name</th>
              <th className="px-3 py-4 text-left">Code</th>
              <th className="px-3 py-4 text-left">Rate (%)</th>
              <th className="px-3 py-4 text-left">Category</th>
              <th className="px-3 py-4 text-left">Status</th>
              <th className="px-3 py-4 text-left">Effective</th>
              <th className="px-3 py-4 text-left">Actions</th>
            </tr>
          </thead>
          <tbody>
            {filtered.map((t, idx) => (
              <tr key={idx} className="border-b">
                <td className="px-3 py-4">{t.name}</td>
                <td className="px-3 py-4">{t.code}</td>
                <td className="px-3 py-4">{t.rate}</td>
                <td className="px-3 py42">
                  <span
                    className={`px-2 py-1 rounded text-xs font-semibold ${
                      t.category === "Property"
                        ? "bg-green-100 text-green-700"
                        : t.category === "Business"
                        ? "bg-blue-100 text-blue-700"
                        : "bg-purple-100 text-purple-700"
                    }`}
                  >
                    {t.category}
                  </span>
                </td>
                <td className="px-3 py-2">
                  <span
                    className={`px-2 py-1 rounded text-xs font-semibold ${
                      t.status === "Active"
                        ? "bg-green-100 text-green-700"
                        : "bg-gray-100 text-gray-500"
                    }`}
                  >
                    {t.status}
                  </span>
                </td>
                <td className="px-3 py-4">{t.effective}</td>
                <td className="px-3 py-4 flex gap-2">
                  <button
                    size="sm"
                    onClick={() => openModal(idx)}
                    className=" text-blue-700"
                  >
                    <FaEdit />
                  </button>
                  <button
                    size="sm"
                    onClick={() => deleteTaxType(idx)}
                    className=" text-red-700"
                  >
                    <FaTrash />
                  </button>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
      {/* Audit Log */}
      <div className="mb-6">
        <div className="font-semibold mb-2 flex items-center gap-2">
          <FaInfoCircle className="text-blue-700"/> Audit Log
        </div>
        <ul className="text-xs text-gray-500 pl-4 flex flex-col gap-5">
          {auditLog.map((log, idx) => (
            <li key={idx}>
              {log.action}{" "}
              <span className="font-bold text-blue-700">{log.type}</span> at{" "}
              {new Date(log.date).toLocaleString()}
            </li>
          ))}
        </ul>
      </div>
      {/* Modal */}
      {showModal && (
        <div className="fixed inset-0 bg-black/30 flex items-center justify-center z-50">
          <div className="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative">
            <button
              className="absolute top-2 right-2 text-4xl text-gray-400 hover:text-red-500"
              onClick={closeModal}
            >
              ×
            </button>
            <h3 className="font-semibold mb-4">
              {editIdx !== null ? "Edit" : "Add"} Tax Type
            </h3>
            <form
              className="space-y-3"
              onSubmit={(e) => {
                e.preventDefault();
                saveTaxType();
              }}
            >
              <Input
                name="name"
                value={form.name}
                onChange={handleFormChange}
                placeholder="Tax Name"
                required
              />
              <Input
                name="code"
                value={form.code}
                onChange={handleFormChange}
                placeholder="Code"
                required
              />
              <Input
                name="rate"
                value={form.rate}
                onChange={handleFormChange}
                placeholder="Rate (%)"
                type="number"
                required
              />
              <Input
                name="description"
                value={form.description}
                onChange={handleFormChange}
                placeholder="Description"
              />
              <select
                name="category"
                value={form.category}
                onChange={handleFormChange}
                className="border rounded px-2 py-1 w-full"
                required
              >
                <option value="">Select Category</option>
                {categories.map((c) => (
                  <option key={c}>{c}</option>
                ))}
              </select>
              <Input
                name="effective"
                value={form.effective}
                onChange={handleFormChange}
                placeholder="Effective Date"
                type="date"
              />
              <Input
                name="exemptions"
                value={form.exemptions}
                onChange={handleFormChange}
                placeholder="Exemptions"
              />
              <div className="flex items-center gap-2">
                <span>Status:</span>
                <select
                  name="status"
                  value={form.status}
                  onChange={handleFormChange}
                  className="border rounded px-2 py-1"
                >
                  {statuses.map((s) => (
                    <option key={s}>{s}</option>
                  ))}
                </select>
              </div>
              <div className="flex justify-end gap-2 mt-4">
                <button type="submit" className="bg-blue-600 py-2 px-6 rounded-sm text-white">
                  Save
                </button>
                <button
                  type="button"
                  onClick={closeModal}
                  className="bg-gray-100 text-gray-700 py-2 px-6 rounded-sm"
                >
                  Cancel
                </button>
              </div>
            </form>
          </div>
        </div>
      )}
    </div>
  );
}
