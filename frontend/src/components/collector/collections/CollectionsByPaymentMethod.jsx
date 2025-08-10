import React from "react";
import { PieChart, Pie, Cell, ResponsiveContainer, Legend } from "recharts";

const data = [
  { name: "Cash", value: 48, color: "#22c55e" },
  { name: "Mobile Money", value: 32, color: "#6366f1" },
  { name: "Card", value: 20, color: "#a78bfa" },
];

export default function CollectionsByPaymentMethod() {
  return (
    <div className="bg-white rounded-lg shadow p-4 border border-gray-100 flex flex-col items-center flex-[0.8]">
      <div className="font-semibold text-lg mb-2">By Payment Method</div>
      <ResponsiveContainer width="100%" height={220}>
        <PieChart>
          <Pie
            data={data}
            dataKey="value"
            nameKey="name"
            cx="50%"
            cy="50%"
            innerRadius={60}
            outerRadius={90}
            paddingAngle={2}
            label={({ name }) => name}
          >
            {data.map((entry, idx) => (
              <Cell key={`cell-${idx}`} fill={entry.color} />
            ))}
          </Pie>
          <Legend verticalAlign="bottom" height={36} iconType="circle" />
        </PieChart>
      </ResponsiveContainer>
      <div className="flex gap-4 mt-2 text-sm">
        <span className="flex items-center gap-1"><span className="w-3 h-3 rounded-full bg-green-500 inline-block" /> Cash</span>
        <span className="flex items-center gap-1"><span className="w-3 h-3 rounded-full bg-indigo-500 inline-block" /> Mobile Money</span>
        <span className="flex items-center gap-1"><span className="w-3 h-3 rounded-full bg-purple-400 inline-block" /> Card</span>
      </div>
    </div>
  );
}
