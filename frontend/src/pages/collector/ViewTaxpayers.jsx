import React from 'react';
import { useParams, useNavigate } from 'react-router-dom';

// Dummy data for demonstration; replace with real data fetching as needed
const taxpayers = {
  'BUS-2023-001': {
    name: 'Adwoa Grocery Shop',
    owner: 'Adwoa Mensah',
    contact: '024 123 4567',
    location: 'Kumasi Central Market',
    type: 'Retail',
    status: 'Active',
    registered: '2023-01-15',
    collections: [
      {
        id: 'PAY-2023-1024',
        taxType: 'Business Operating Permit',
        amount: 'GHS 200.00',
        date: '12 Jul, 2023',
        paymentMethod: 'Cash',
        receipt: 'RCP 2023 5642',
      },
    ],
  },
  'BUS-2023-002': {
    name: 'Afia Restaurant',
    owner: 'Afia Owusu',
    contact: '020 987 6543',
    location: 'Accra Mall',
    type: 'Restaurant',
    status: 'Active',
    registered: '2023-02-10',
    collections: [
      {
        id: 'PAY-2023-1023',
        taxType: 'Food & Beverage License',
        amount: 'GHS 150.00',
        date: '12 Jul, 2023',
        paymentMethod: 'MOMO',
        receipt: 'RCP 2023 5641',
      },
    ],
  },
};

const ViewTaxpayers = () => {
  const { businessId } = useParams();
  const navigate = useNavigate();
  const taxpayer = taxpayers[businessId];

  if (!taxpayer) {
    return (
      <div className="p-8 text-center text-red-500">Taxpayer not found.</div>
    );
  }

  return (
    <div className="max-w-5xl mx-auto p-6 bg-white rounded-lg shadow mt-5">
      <div className="flex justify-between items-center mb-6">
        <h2 className="text-2xl font-bold text-gray-800">Taxpayer Details</h2>
        <button
          onClick={() => navigate(-1)}
          className="px-4 py-2 bg-gray-100 rounded hover:bg-gray-200 text-gray-700"
        >
          Back
        </button>
      </div>
      <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div>
          <div className="text-gray-500 text-xs">Business Name</div>
          <div className="font-semibold text-lg text-gray-800">{taxpayer.name}</div>
        </div>
        <div>
          <div className="text-gray-500 text-xs">Owner</div>
          <div className="font-semibold text-lg text-gray-800">{taxpayer.owner}</div>
        </div>
        <div>
          <div className="text-gray-500 text-xs">Contact</div>
          <div className="font-semibold text-lg text-gray-800">{taxpayer.contact}</div>
        </div>
        <div>
          <div className="text-gray-500 text-xs">Location</div>
          <div className="font-semibold text-lg text-gray-800">{taxpayer.location}</div>
        </div>
        <div>
          <div className="text-gray-500 text-xs">Type</div>
          <div className="font-semibold text-lg text-gray-800">{taxpayer.type}</div>
        </div>
        <div>
          <div className="text-gray-500 text-xs">Status</div>
          <span className={`px-2 py-1 text-xs font-semibold rounded-full ${taxpayer.status === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}`}>{taxpayer.status}</span>
        </div>
        <div>
          <div className="text-gray-500 text-xs">Registered</div>
          <div className="font-semibold text-lg text-gray-800">{taxpayer.registered}</div>
        </div>
      </div>
      <div>
        <h3 className="text-lg font-bold text-gray-700 mb-2">Collections</h3>
        <div className="overflow-x-auto">
          <table className="min-w-full text-sm border">
            <thead>
              <tr className="bg-gray-50 text-gray-500">
                <th className="px-4 py-2 text-left">ID</th>
                <th className="px-4 py-2 text-left">Tax Type</th>
                <th className="px-4 py-2 text-left">Amount</th>
                <th className="px-4 py-2 text-left">Date</th>
                <th className="px-4 py-2 text-left">Payment</th>
                <th className="px-4 py-2 text-left">Receipt</th>
              </tr>
            </thead>
            <tbody>
              {taxpayer.collections.map((c) => (
                <tr key={c.id} className="border-b last:border-b-0">
                  <td className="px-4 py-2">{c.id}</td>
                  <td className="px-4 py-2">{c.taxType}</td>
                  <td className="px-4 py-2">{c.amount}</td>
                  <td className="px-4 py-2">{c.date}</td>
                  <td className="px-4 py-2">{c.paymentMethod}</td>
                  <td className="px-4 py-2">{c.receipt}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  );
};

export default ViewTaxpayers;