import React from "react";

const summary = [
  { label: "Today", value: "GHS 650.00", collections: 4 },
  { label: "Yesterday", value: "GHS 1,025.00", collections: 6 },
  { label: "This Week", value: "GHS 4,250.00", collections: 24 },
  { label: "This Month", value: "GHS 12,350.00", collections: 68 },
];

export default function CollectionsSummary() {
  return (
    <div className="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
      {summary.map((item, idx) => (
          <div key={idx} className="bg-white rounded-lg shadow p-4 border border-gray-100 flex flex-col justify-between">
            <div className="flex items-center justify-between mb-1">
              <span className="font-semibold text-gray-700">{item.label}</span>
              <span
                className={`ri-calendar-line text-lg rounded-full px-2 py-1 ${[
                  'bg-green-100 text-green-600',
                  'bg-blue-100 text-blue-600',
                  'bg-yellow-100 text-yellow-600',
                  'bg-purple-100 text-purple-600',
                ][idx % 4]}`}
              />
            </div>
          <div className="text-xl font-bold mb-1">{item.value}</div>
          <div className="text-xs text-gray-500">{item.collections} collections</div>
        </div>
      ))}
    </div>
  );
}
