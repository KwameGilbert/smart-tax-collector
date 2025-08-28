import React from "react";
import { PieChart, Pie, Cell, Tooltip, ResponsiveContainer, BarChart, Bar, XAxis, YAxis, CartesianGrid, Legend } from "recharts";
import { Users, ShieldCheck } from "lucide-react";

const pieData = [
  { name: "Individual", value: 60 },
  { name: "Partnership", value: 25 },
  { name: "Corporate", value: 15 },
];

const barData = [
  { name: "Compliant", value: 70 },
  { name: "Partial", value: 20 },
  { name: "Non-Compliant", value: 10 },
];

const COLORS = ["#2563eb", "#cbd5e1", "#f1f5f9"];

export default function TaxpayerCharts() {
  return (
    <div className="grid grid-cols-1 md:grid-cols-2 gap-6 py-3">
      
      {/* Taxpayer Categories Distribution */}
      <div className="bg-white p-6 rounded-md shadow-sm border border-gray-100">
        <div className="flex items-center gap-2 mb-2">
          <Users className="text-orange-600 w-5 h-5" />
          <h2 className="text-lg font-semibold text-gray-800">Taxpayer Categories Distribution</h2>
        </div>
        <p className="text-sm text-gray-500 mb-4">Breakdown by taxpayer type</p>
        <ResponsiveContainer width="100%" height={250}>
          <PieChart>
            <Pie
              data={pieData}
              cx="50%"
              cy="50%"
              labelLine={false}
              label={({ name, percent }) => `${name} ${(percent * 100).toFixed(0)}%`}
              outerRadius={80}
              fill="#8884d8"
              dataKey="value"
            >
              {pieData.map((entry, index) => (
                <Cell key={`cell-${index}`} fill={COLORS[index % COLORS.length]} />
              ))}
            </Pie>
            <Tooltip />
          </PieChart>
        </ResponsiveContainer>
      </div>

      {/* Compliance Status Overview */}
      <div className="bg-white p-6 rounded-md shadow-sm border border-gray-100">
        <div className="flex items-center gap-2 mb-2">
          <ShieldCheck className="text-green-600 w-5 h-5" />
          <h2 className="text-lg font-semibold text-gray-800">Compliance Status Overview</h2>
        </div>
        <p className="text-sm text-gray-500 mb-4">Taxpayer compliance distribution</p>
        <ResponsiveContainer width="100%" height={250}>
          <BarChart data={barData}>
            <CartesianGrid strokeDasharray="3 3" />
            <XAxis dataKey="name" />
            <YAxis />
            <Tooltip />
            <Legend />
            <Bar dataKey="value" fill="#16a34a" radius={[6, 6, 0, 0]} />
          </BarChart>
        </ResponsiveContainer>
      </div>
    </div>
  );
}
