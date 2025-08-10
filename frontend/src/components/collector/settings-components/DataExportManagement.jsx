import React from "react";

const DataExportManagement = () => (
  <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div className="bg-white rounded-lg shadow-sm p-6">
      <h2 className="text-lg font-semibold mb-1">Data Export</h2>
      <p className="text-xs text-gray-500 mb-4">Download your performance data and reports</p>
      <div className="space-y-3">
        <button className="flex items-center w-full border rounded px-3 py-2 text-sm mb-2 hover:bg-gray-50">
          <span className="ri-file-excel-line text-green-500 mr-2" />Export Performance Data
        </button>
        <button className="flex items-center w-full border rounded px-3 py-2 text-sm mb-2 hover:bg-gray-50">
          <span className="ri-file-list-2-line text-blue-500 mr-2" />Export Collection History
        </button>
        <button className="flex items-center w-full border rounded px-3 py-2 text-sm hover:bg-gray-50">
          <span className="ri-user-line text-purple-500 mr-2" />Export Personal Information
        </button>
      </div>
    </div>
    <div className="bg-white rounded-lg shadow-sm p-6 flex flex-col justify-between">
      <div>
        <h2 className="text-lg font-semibold mb-1">Data Management</h2>
        <p className="text-xs text-gray-500 mb-4">Manage your account data and privacy settings</p>
        <div className="bg-gray-50 rounded p-3 text-xs text-gray-600 mb-4">
          Your data is securely stored and managed according to government privacy standards. Contact your administrator for data deletion requests.
        </div>
      </div>
      <button className="w-full bg-red-500 text-white py-2 rounded">Request Data Deletion</button>
    </div>
  </div>
);

export default DataExportManagement;
