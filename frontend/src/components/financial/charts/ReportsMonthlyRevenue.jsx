import {
  BarChart,
  Bar,
  XAxis,
  YAxis,
  Tooltip,
  Legend,
  ResponsiveContainer,
  CartesianGrid,
} from "recharts";

const monthlyData = [
  { name: "Jan", revenue: 900 },
  { name: "Feb", revenue: 850 },
  { name: "Mar", revenue: 900 },
  { name: "Apr", revenue: 300 },
  { name: "May", revenue: 100 },
  
];

export default function ReportsMonthlyRevenue() {
  return (
    <div className="bg-white rounded-md shadow py-6 px-3 h-full">
      <h2 className="text-xl font-semibold mb-2">Monthly Revenue (2023)</h2>
      <ResponsiveContainer width="100%" height={370}>
        <BarChart
          data={monthlyData}
          margin={{ top: 30, right: 10, left: 0, bottom: 0 }}
        >
          <CartesianGrid stroke="#e5e7eb" />
          <XAxis dataKey="name" />
          <YAxis tickFormatter={(v) => `GHS ${v}`} />
          <Tooltip formatter={(v) => `GHS ${v}`} contentStyle={{ fontSize: '10px' }} />
          <Legend iconType="plainline" wrapperStyle={{ top: 0 }} />
          <Bar
            dataKey="revenue"
            name="Monthly Revenue (GHS)"
            fill="#9698F9EF"
            stroke="#7275F9FF"
            barSize={55}
            radius={[4, 4, 0, 0]}
          />
        </BarChart>
      </ResponsiveContainer>
    </div>
  );
}
