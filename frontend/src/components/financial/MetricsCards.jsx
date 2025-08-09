import React, { useState, useEffect } from 'react';
import { CircleDollarSign, User2, Percent, Siren } from 'lucide-react';
import axios from 'axios';
import Swal from 'sweetalert2';

const iconMap = {
  "Total Revenue": (
    <div className="bg-green-100 p-2 rounded-sm">
      <CircleDollarSign className="w-5 h-5 text-green-600" />
    </div>
  ),
  "Tax Payers": (
    <div className="bg-blue-100 p-2 rounded-sm">
      <User2 className="w-5 h-5 text-blue-600" />
    </div>
  ),
  "Collection Rate": (
    <div className="bg-violet-100 p-2 rounded-sm">
      <Percent className="w-5 h-5 text-violet-600" />
    </div>
  ),
  "Overdue Taxes": (
    <div className="bg-red-100 p-2 rounded-sm">
      <Siren className="w-5 h-5 text-red-600" />
    </div>
  ),
};

const MetricsCards = () => {
  const [stats, setStats] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(false);

  useEffect(() => {
    axios.get('/assets/data/metricscards.json')
      .then(res => {
        console.log("Response Data:", res.data.stat);
        setStats(res.data.stat);
        setLoading(false);
      })
      .catch(err => {
        setError(true);
        setLoading(false);

      });
  }, []);

  if (loading) {
    return (
      <div className="flex items-center justify-center h-40">
        <div className="w-12 h-12 border-4 border-blue-400 border-t-transparent rounded-full animate-spin"></div>
      </div>
    );
  }

  if (error) {
    return (
      <div className="text-center text-red-500 py-6">
        ❌ Failed to load metrics. Please try again later.
      </div>
    );
  }

  return (
    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
      {stats.map(({ title, value }) => (
        <div key={title} className="bg-white rounded-lg shadow p-6 hover:shadow-md transition-all">
          <div className="flex items-center justify-between mb-4">
            <h3 className="text-sm font-medium text-gray-500">{title}</h3>
            {iconMap[title] || <div className="p-2" />}
          </div>
          <p className="text-2xl font-bold">
            {title === 'Collection Rate'
              ? `${value.toFixed(2)}%`
              : title.includes('Revenue') || title.includes('Taxes')
              ? `GHS ${value.toLocaleString(undefined, { minimumFractionDigits: 2 })}`
              : value.toLocaleString()}
          </p>
        </div>
      ))}
    </div>
  );
};

export default MetricsCards;
