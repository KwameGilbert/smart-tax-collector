import React, { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';
import axios from 'axios';
import { Mail, Phone, User, Calendar, BadgeCheck, MapPin, UserCheck, UserX, TrendingUp, TrendingDown } from 'lucide-react';

const CollectorsManagementView = () => {
  const { id } = useParams();
  const [collector, setCollector] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    axios.get('/assets/data/collectors.json')
      .then(res => {
        const found = res.data.find(c => String(c.id) === String(id));
        setCollector(found);
        setLoading(false);
      })
      .catch(() => setLoading(false));
  }, [id]);

  // Pagination state for collections
  const [currentPage, setCurrentPage] = useState(1);
  const itemsPerPage = 5;

  if (loading) {
    return <div className="text-center py-20 text-gray-500 text-lg">Loading collector details...</div>;
  }

  if (!collector) {
    return <div className="text-center py-20 text-red-400 text-lg">Collector not found.</div>;
  }

  // Paginate collections
  const collections = collector.collections || [];
  const totalPages = Math.ceil(collections.length / itemsPerPage);
  const paginatedCollections = collections.slice((currentPage - 1) * itemsPerPage, currentPage * itemsPerPage);

  return (
    <div className="max-w-5xl mx-auto bg-white rounded-2xl shadow-lg p-6 md:p-10 mt-10">
      {/* Header and Status */}
      <div className="flex flex-col md:flex-row md:items-center md:justify-between gap-2 mb-6">
        <div className="flex items-center gap-3">
          <div className="h-16 w-16 rounded-full bg-gray-200 flex items-center justify-center text-gray-400 text-3xl">
            <User size={36} />
          </div>
          <div>
            <div className="flex items-center gap-2">
              <span className="text-lg font-bold text-gray-800">{collector.name}</span>
              <span className={`ml-2 px-2 py-0.5 rounded-full text-xs font-semibold ${
                collector.status === 'Active' ? 'bg-blue-100 text-blue-700' : 'bg-gray-200 text-gray-500'
              }`}>{collector.status}</span>
            </div>
            <div className="text-sm text-gray-500">{collector.role || 'Tax Collector'}</div>
            <div className="text-xs text-gray-400">ID: {collector.id}</div>
          </div>
        </div>
        <div className="flex flex-wrap gap-4 mt-2 md:mt-0 text-sm text-gray-600">
          <div className="flex items-center gap-1"><Mail size={14}/> {collector.email || '-'}</div>
          <div className="flex items-center gap-1"><Phone size={14}/> {collector.contact || '-'}</div>
          <div className="flex items-center gap-1"><MapPin size={14}/> {collector.location}</div>
          <div className="flex items-center gap-1"><Calendar size={14}/> Joined {collector.dateJoined || '-'}</div>
        </div>
      </div>

      {/* Stats Cards */}
      <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div className="bg-gray-50 rounded-lg p-6 flex flex-col items-start shadow-sm">
          <span className="text-xs text-gray-500 mb-1">Total Collections</span>
          <span className="text-2xl font-bold text-gray-800">{collector.totalCollections || 'GHS 0'}</span>
          <span className="text-xs text-green-600 mt-1">↑ {collector.totalCollectionsChange || '0%'} from last month</span>
        </div>
        <div className="bg-gray-50 rounded-lg p-6 flex flex-col items-start shadow-sm">
          <span className="text-xs text-gray-500 mb-1">Collection Rate</span>
          <span className="text-2xl font-bold text-gray-800">{collector.collectionRate || '0%'}</span>
        </div>
        <div className="bg-gray-50 rounded-lg p-6 flex flex-col items-start shadow-sm">
          <span className="text-xs text-gray-500 mb-1">Total Taxpayers</span>
          <span className="text-2xl font-bold text-gray-800">{collector.totalTaxpayers || '0'}</span>
          <span className="text-xs text-green-600 mt-1">↑ {collector.totalTaxpayersChange || '0%'} from last month</span>
        </div>
      </div>

      {/* Target Progress */}
      <div className="bg-white rounded-lg shadow-sm p-6 mb-8">
        <div className="flex items-center justify-between mb-2">
          <span className="font-semibold text-gray-700">Target Progress</span>
          <span className="text-xs text-gray-500 font-medium">{collector.targetProgress || '81.7%'}</span>
        </div>
        <div className="w-full h-3 bg-gray-200 rounded-full overflow-hidden mb-2">
          <div className="h-full bg-blue-500 rounded-full" style={{ width: collector.targetProgress || '81.7%' }}></div>
        </div>
        <div className="flex justify-between text-xs text-gray-600">
          <span>Avg. Collection<br/><span className="font-bold text-base text-gray-800">{collector.avgCollection || 'GHS 0'}</span></span>
          <span>Remaining<br/><span className="font-bold text-base text-gray-800">{collector.targetRemaining || 'GHS 0'}</span></span>
        </div>
      </div>

      {/* Collections Table */}
      <div className="bg-white rounded-lg shadow p-6">
        <div className="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-2">
          <h3 className="text-lg font-bold text-gray-800 mb-2 md:mb-0">Collections History</h3>
          <div className="flex gap-2">
            <input type="text" placeholder="Search by business, tax type, receipt..." className="border px-3 py-2 rounded-md text-sm focus:outline-none focus:ring focus:border-blue-300" />
            <select className="border px-2 py-2 rounded-md text-sm">
              <option>All Status</option>
              <option>Completed</option>
              <option>Pending</option>
            </select>
            <select className="border px-2 py-2 rounded-md text-sm">
              <option>Date</option>
              <option>Amount</option>
            </select>
          </div>
        </div>
        <div className="overflow-x-auto">
          <table className="min-w-full text-sm">
            <thead>
              <tr className="bg-gray-50 text-gray-500">
                <th className="px-4 py-3 text-left font-medium">Taxpayer</th>
                <th className="px-4 py-3 text-left font-medium">Tax Type</th>
                <th className="px-4 py-3 text-left font-medium">Amount</th>
                <th className="px-4 py-3 text-left font-medium">Payment Method</th>
                <th className="px-4 py-3 text-left font-medium">Date</th>
                <th className="px-4 py-3 text-left font-medium">Status</th>
                <th className="px-4 py-3 text-left font-medium">Receipt</th>
              </tr>
            </thead>
            <tbody>
              {paginatedCollections.length > 0 ? (
                paginatedCollections.map((col, idx) => (
                  <tr key={idx} className="border-b last:border-b-0 hover:bg-gray-50">
                    <td className="px-4 py-3 font-semibold text-blue-900">
                      {col.businessName || '-'}
                      <div className="text-xs text-gray-400">{col.businessId || ''}</div>
                    </td>
                    <td className="px-4 py-3">
                      <span className="inline-block bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs font-medium">{col.taxType || '-'}</span>
                    </td>
                    <td className="px-4 py-3 font-bold text-gray-800">{col.amount || '-'}</td>
                    <td className="px-4 py-3">
                      <span className={`rounded px-2 py-1 text-xs font-semibold ${
                        col.method === 'Bank Transfer' ? 'bg-blue-100 text-blue-700' :
                        col.method === 'Credit Card' ? 'bg-purple-100 text-purple-700' :
                        col.method === 'Check' ? 'bg-yellow-100 text-yellow-700' :
                        'bg-green-100 text-green-700'
                      }`}>
                        {col.method || '-'}
                      </span>
                    </td>
                    <td className="px-4 py-3">{col.date || '-'}</td>
                    <td className="px-4 py-3">
                      <span className={`rounded px-2 py-1 text-xs font-semibold ${
                        col.status === 'completed' ? 'bg-blue-600 text-white' :
                        col.status === 'pending' ? 'bg-yellow-400 text-white' :
                        'bg-gray-200 text-gray-500'
                      }`}>
                        {col.status || '-'}
                      </span>
                    </td>
                    <td className="px-4 py-3">{col.receipt || '-'}</td>
                  </tr>
                ))
              ) : (
                <tr>
                  <td colSpan={7} className="text-center py-6 text-gray-400">No collections found.</td>
                </tr>
              )}
            </tbody>
          </table>
        </div>
        {/* Pagination */}
        <div className="flex justify-between items-center mt-4 text-xs text-gray-500">
          <span>Showing {(currentPage - 1) * itemsPerPage + 1} to {Math.min(currentPage * itemsPerPage, collections.length)} of {collections.length} results</span>
          <div className="flex gap-1">
            <button
              className={`px-2 py-1 rounded ${currentPage === 1 ? 'bg-blue-100 text-blue-700 font-bold' : 'hover:bg-gray-200'}`}
              onClick={() => setCurrentPage(p => Math.max(p - 1, 1))}
              disabled={currentPage === 1}
            >Previous</button>
            {Array.from({ length: totalPages }, (_, i) => i + 1).map(page => (
              <button
                key={page}
                className={`px-2 py-1 rounded ${currentPage === page ? 'bg-blue-600 text-white font-bold' : 'hover:bg-gray-200'}`}
                onClick={() => setCurrentPage(page)}
              >{page}</button>
            ))}
            <button
              className={`px-2 py-1 rounded ${currentPage === totalPages ? 'bg-blue-100 text-blue-700 font-bold' : 'hover:bg-gray-200'}`}
              onClick={() => setCurrentPage(p => Math.min(p + 1, totalPages))}
              disabled={currentPage === totalPages}
            >Next</button>
          </div>
        </div>
      </div>
    </div>
  );
}

export default CollectorsManagementView;