import React, { useEffect, useState } from "react";
import axios from "axios";
import {
  LineChart,
  Line,
  XAxis,
  YAxis,
  Tooltip,
  CartesianGrid,
  ResponsiveContainer,
  PieChart, // ✅ Correct component
  Pie,
  Cell,
  Legend,
} from "recharts";

const COLORS = [
  "rgba(16, 185, 129, 0.8)", // Cash
  "rgba(59, 130, 246, 0.8)", // Mobile Money
  "rgba(139, 92, 246, 0.8)", // Bank Transfer
];

const PaymentCharts = () => {
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    axios
      .get("/assets/data/paymentsChart.json")
      .then((res) => {
        setData(res.data);
        setLoading(false);
      })
      .catch((err) => {
        console.error("Failed to fetch chart data", err);
        setLoading(false);
      });
  }, []);

  if (loading) {
    return <div className="p-6 text-gray-500">Loading charts...</div>;
  }

  const monthlyRevenueData = Object.entries(data.monthlyRevenue).map(
    ([month, value]) => ({ month, revenue: value })
  );

  const paymentMethodData = Object.entries(data.paymentMethods).map(
    ([method, value]) => ({ name: method, value })
  );

  return (
    <div className="grid grid-cols-1 md:grid-cols-2 gap-6 py-6">
      <div className="bg-white p-4 rounded shadow">
        <h2 className="font-semibold mb-2">Revenue Trend (2023)</h2>
        <ResponsiveContainer width="100%" height={300}>
          <LineChart data={monthlyRevenueData}>
            <CartesianGrid strokeDasharray="3 3" />
            <XAxis dataKey="month" />
            <YAxis />
            <Tooltip />
            <Line
              type="monotone"
              dataKey="revenue"
              stroke="#2563eb"
              strokeWidth={2}
              fill="rgba(37, 99, 235, 0.1)"
              dot={{ r: 4 }}
            />
          </LineChart>
        </ResponsiveContainer>
      </div>

      <div className="bg-white p-4 rounded shadow">
        <h2 className="font-semibold mb-2">Payment Method Distribution</h2>
        <ResponsiveContainer width="100%" height={300}>
          <PieChart>
            <Pie
              data={paymentMethodData}
              dataKey="value"
              nameKey="name"
              outerRadius={100}
              innerRadius={50} // 👈 Makes it a doughnut
              label
            >
              {paymentMethodData.map((entry, index) => (
                <Cell key={index} fill={COLORS[index % COLORS.length]} />
              ))}
            </Pie>
            <Legend verticalAlign="bottom" />
            <Tooltip />
          </PieChart>
        </ResponsiveContainer>
      </div>
    </div>
  );
};

export default PaymentCharts;
