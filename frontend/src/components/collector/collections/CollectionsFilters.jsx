import React from "react";
import { CiExport } from "react-icons/ci";

export default function CollectionsFilters({ onApply, onReset }) {
  return (
    <div className="flex flex-wrap gap-4 items-center mb-4 bg-white p-4 rounded-lg shadow">
      <input type="text" placeholder="Select date range" className="border rounded px-3 py-2 text-sm w-40" />
      <select className="border rounded px-3 py-2 text-sm">
        <option>All Tax Types</option>
        <option>Business Tax</option>
        <option>Income Tax</option>
      </select>
      <select className="border rounded px-3 py-2 text-sm">
        <option>All Methods</option>
        <option>Cash</option>
        <option>Mobile Money</option>
        <option>Card</option>
      </select>
      <input type="text" placeholder="Search by business name" className="border rounded px-3 py-2 text-sm w-48" />
      <button className="bg-green-600 text-white px-4 py-2 rounded shadow" onClick={onApply}>Apply</button>
      <button className="bg-gray-100 text-gray-700 px-4 py-2 rounded shadow" onClick={onReset}>Reset</button>
      <button className="bg-white border px-4 py-2 rounded shadow flex items-center gap-2">
        <CiExport  className="w-5 h-5 text-gray-800" /> Export
      </button>
    </div>
  );
}
