import React, { useEffect, useState } from 'react';
import axios from 'axios';
import {
  LineChart, Line, XAxis, YAxis, CartesianGrid, Tooltip, ResponsiveContainer
} from 'recharts';

const MonthlyCollectionsChart = () => {
  const [data, setData] = useState([]);

  useEffect(() => {
    axios.get('/assets/data/monthly_collectors.json')
      .then(response => {
        setData(response.data);
      })
      .catch(error => {
        console.error('Error fetching chart data:', error);
      });
  }, []);

  return (
    <div className="bg-white p-6 rounded-lg shadow mb-6">
      <h2 className="text-xl font-semibold mb-4 text-gray-800">Monthly Collections</h2>
      <ResponsiveContainer width="100%" height={400}>
        <LineChart data={data}>
          <CartesianGrid strokeDasharray="3 3" />
          <XAxis dataKey="month" />
          <YAxis tickFormatter={value => `GHS ${value / 1000}k`} />
          <Tooltip formatter={(value) => [`GHS ${value.toLocaleString()}`, 'Amount']} />
          <Line
            type="monotone"
            dataKey="amount"
            stroke="#4f46e5"
            strokeWidth={2}
            fillOpacity={0.1}
            fill="#4f46e5"
            dot={{ r: 4 }}
            activeDot={{ r: 6 }}
          />
        </LineChart>
      </ResponsiveContainer>
    </div>
  );
};

export default MonthlyCollectionsChart;
