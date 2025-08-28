import React from "react";
import {
  LineChart,
  Line,
  XAxis,
  YAxis,
  CartesianGrid,
  Tooltip,
  Legend,
  ResponsiveContainer
} from "recharts";

const data = [
  { name: "Jan", current: 13, target: 10, previous: 9 },
  { name: "Feb", current: 15, target: 12, previous: 12 },
  { name: "Mar", current: 18, target: 14, previous: 14 },
  { name: "Apr", current: 21, target: 16, previous: 15 },
  { name: "May", current: 19, target: 18, previous: 17 },
  { name: "Jun", current: 24, target: 21, previous: 18 }
];

const ExecutiveMonthlyCollectionsChart = () => {
  return (
    <div className="p-4 bg-white rounded-md shadow-md">
      <h2 className="text-xl font-semibold">Monthly Collections (GHS Millions)</h2>
      <p className="text-sm text-gray-500 mb-5">
        Current year vs. target and previous year comparison
      </p>
      <div className="h-90 w-full">
        <ResponsiveContainer>
          <LineChart data={data}>
            <CartesianGrid strokeDasharray="3 3" stroke="#e0e0e0" />
            <XAxis dataKey="name" />
            <YAxis domain={[0, 28]} />
            <Tooltip />
            <Legend />
            <Line
              type="monotone"
              dataKey="current"
              name="Current Collections"
              stroke="#3b82f6"
              strokeWidth={3}
              dot={{ r: 4, stroke: "#3b82f6", fill: "white", strokeWidth: 2 }}
              activeDot={{ r: 6 }}
            />
            <Line
              type="monotone"
              dataKey="target"
              name="Target"
              stroke="#22c55e"
              strokeWidth={2}
              strokeDasharray="5 5"
              dot={{ r: 3, stroke: "#22c55e", fill: "white", strokeWidth: 1.5 }}
            />
            <Line
              type="monotone"
              dataKey="previous"
              name="Previous Year"
              stroke="#f59e0b"
              strokeWidth={2}
              dot={{ r: 3, stroke: "#f59e0b", fill: "white", strokeWidth: 1.5 }}
            />
          </LineChart>
        </ResponsiveContainer>
      </div>
    </div>
  );
};

export default ExecutiveMonthlyCollectionsChart;
