import React from "react";

export default function PerformanceHeader() {
  return (
    <div className="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
      <div>
        <h1 className="text-2xl font-bold text-gray-800">Performance Dashboard</h1>
        <p className="text-gray-600">Track your tax collection performance and goals</p>
      </div>
      <div className="flex gap-2 items-center">
        <button className="bg-white border px-4 py-2 rounded-lg text-gray-700 flex items-center gap-2 shadow-sm">
          <span className="ri-calendar-line text-lg" /> This Month
        </button>
        <button className="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-semibold shadow flex items-center gap-2">
          Generate Report
        </button>
      </div>
    </div>
  );
}
