import React from "react";

const SupportResources = () => (
  <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div className="bg-white rounded-lg shadow-sm p-6">
      <h2 className="text-lg font-semibold mb-1">Support & Resources</h2>
      <p className="text-xs text-gray-500 mb-4">Get help and access documentation</p>
      <div className="space-y-3">
        <button className="flex items-center w-full border rounded px-3 py-2 text-sm mb-2 hover:bg-gray-50">
          <span className="ri-book-2-line text-green-500 mr-2" />User Manual
        </button>
        <button className="flex items-center w-full border rounded px-3 py-2 text-sm mb-2 hover:bg-gray-50">
          <span className="ri-video-line text-blue-500 mr-2" />Video Tutorials
        </button>
        <button className="flex items-center w-full border rounded px-3 py-2 text-sm mb-2 hover:bg-gray-50">
          <span className="ri-customer-service-2-line text-purple-500 mr-2" />Contact Support
        </button>
        <button className="flex items-center w-full border rounded px-3 py-2 text-sm hover:bg-gray-50">
          <span className="ri-bug-line text-gray-500 mr-2" />Report a Bug
        </button>
      </div>
    </div>
    <div className="bg-white rounded-lg shadow-sm p-6">
      <h2 className="text-lg font-semibold mb-1">System Information</h2>
      <p className="text-xs text-gray-500 mb-4">Current system status and version information</p>
      <div className="space-y-2 text-sm">
        <div className="flex justify-between"><span>Version</span><span>v2.4.1</span></div>
        <div className="flex justify-between"><span>Last Update</span><span>Dec 15, 2024</span></div>
        <div className="flex justify-between"><span>System Status</span><span className="bg-green-500 text-white px-2 py-0.5 rounded text-xs">Online</span></div>
        <div className="flex justify-between"><span>Region</span><span>US-East</span></div>
      </div>
    </div>
  </div>
);

export default SupportResources;
