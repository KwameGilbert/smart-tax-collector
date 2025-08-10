import React from "react";
import { LineChart, Line, XAxis, YAxis, Tooltip, ResponsiveContainer, CartesianGrid } from "recharts";

const data = [
  { name: "4 Days Ago", value: 800 },
  { name: "3 Days Ago", value: 850 },
  { name: "2 Days Ago", value: 900 },
  { name: "Yesterday", value: 1000 },
  { name: "Today", value: 650 },
];

export default function CollectionsOverTime() {
  return (
    <div className="bg-white rounded-lg shadow p-4 border border-gray-100 flex-[1.6]">
      <div className="font-semibold text-lg mb-2">Collections Over Time</div>
      <ResponsiveContainer width="100%" height={320}>
        <LineChart data={data} margin={{ top: 10, right: 0, left: 0, bottom: 0 }}>
          <CartesianGrid stroke="#e5e7eb" />
          <XAxis dataKey="name" fontSize={10} />
          <YAxis fontSize={10} tickFormatter={(v) => `GHS ${v}`} />
          <Tooltip formatter={(v) => `GHS ${v}`} contentStyle={{ fontSize: '10px' }} />
          <Line type="monotone" dataKey="value" stroke="#22c55e" strokeWidth={3} dot={{ r: 5, fill: '#22c55e' }} activeDot={{ r: 7 }} fillOpacity={0.2} />
        </LineChart>
      </ResponsiveContainer>
    </div>
  );
}
