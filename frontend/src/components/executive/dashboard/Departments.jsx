import React from "react";
import { Search, Filter, Download } from "lucide-react";

const data = [
  {
    department: "Corporate Tax",
    collected: "GHS 45.2M",
    target: "GHS 42.0M",
    achievement: "107.6%",
    status: "Above Target",
  },
  {
    department: "Income Tax",
    collected: "GHS 38.7M",
    target: "GHS 40.0M",
    achievement: "96.8%",
    status: "Below Target",
  },
  {
    department: "Sales Tax",
    collected: "GHS 22.4M",
    target: "GHS 20.0M",
    achievement: "112.0%",
    status: "Above Target",
  },
  {
    department: "Property Tax",
    collected: "GHS 19.3M",
    target: "GHS 18.0M",
    achievement: "107.2%",
    status: "Above Target",
  },
];

const DepartmentPerformance = () => {
  return (
    <div className="p-4 bg-white rounded-md my-6 shadow-md">
      <div className="flex justify-between items-center mb-4">
        <h2 className="text-lg font-semibold">Department Performance</h2>
        <div className="flex items-center gap-2">
          <div className="relative">
            <input
              type="text"
              placeholder="Search..."
              className="pl-10 pr-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
            <Search className="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" />
          </div>
          <button className="flex items-center gap-1 px-3 py-2 border rounded-lg text-sm hover:bg-gray-50">
            <Filter className="w-4 h-4" /> Filter
          </button>
          <button className="flex items-center gap-1 px-3 py-2 border rounded-lg text-sm hover:bg-gray-50">
            <Download className="w-4 h-4" /> Export
          </button>
        </div>
      </div>

      <div className="overflow-x-auto">
        <table className="w-full text-sm text-left border-collapse">
          <thead>
            <tr className="bg-gray-50 text-gray-600">
              <th className="py-6 px-4">DEPARTMENT</th>
              <th className="py-6 px-4">COLLECTED</th>
              <th className="py-6 px-4">TARGET</th>
              <th className="py-6 px-4">ACHIEVEMENT</th>
              <th className="py-6 px-4">STATUS</th>
            </tr>
          </thead>
          <tbody>
            {data.map((row, index) => (
              <tr
                key={index}
                className="border-t hover:bg-gray-50 transition-colors"
              >
                <td className="py-6 px-4 font-medium">{row.department}</td>
                <td className="py-6 px-4">{row.collected}</td>
                <td className="py-6 px-4">{row.target}</td>
                <td className="py-6 px-4">{row.achievement}</td>
                <td
                  className={`py-6 px-4 font-medium ${
                    row.status === "Above Target"
                      ? "text-green-600"
                      : "text-red-500"
                  }`}
                >
                  {row.status}
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </div>
  );
};

export default DepartmentPerformance;
