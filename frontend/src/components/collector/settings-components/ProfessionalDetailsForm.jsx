import React from "react";

export default function ProfessionalDetailsForm() {
  return (
    <div className="bg-white rounded-xl shadow p-6 border border-gray-100 flex-[0.9]">
      <h3 className="font-semibold text-lg mb-4 text-gray-800">Professional Details</h3>
      <p className="text-gray-500 text-sm mb-4">Work-related information and credentials</p>
      <form className="space-y-4">
        <div className="flex gap-4">
          <div className="flex-1">
            <label className="block text-sm font-medium mb-1">Employee ID</label>
            <input type="text" className="w-full border rounded p-2" value="TC-2024-1156" />
          </div>
          <div className="flex-1">
            <label className="block text-sm font-medium mb-1">Position</label>
            <input type="text" className="w-full border rounded p-2" value="Senior Tax Collector" />
          </div>
        </div>
        <div className="flex gap-4">
          <div className="flex-1">
            <label className="block text-sm font-medium mb-1">Start Date</label>
            <input type="date" className="w-full border rounded p-2" value="2022-03-15" />
          </div>
          <div className="flex-1">
            <label className="block text-sm font-medium mb-1">Supervisor</label>
            <input type="text" className="w-full border rounded p-2" value="Sarah Johnson" />
          </div>
        </div>
        <div>
          <label className="block text-sm font-medium mb-1">Bio</label>
          <textarea className="w-full border rounded p-2" rows={6} defaultValue="Experienced tax collection professional with over 5 years in revenue collection and taxpayer relations. Specialized in high-value case resolution and compliance enforcement." />
        </div>
        <div>
          <label className="block text-sm font-medium mb-1">Certifications</label>
          <div className="flex gap-2 flex-wrap mt-2">
            <span className="px-3 py-1 rounded bg-green-100 text-green-700 text-xs font-semibold">Certified Tax Collector</span>
            <span className="px-3 py-1 rounded bg-gray-100 text-gray-700 text-xs font-semibold">Revenue Management</span>
            <span className="px-3 py-1 rounded bg-yellow-100 text-yellow-700 text-xs font-semibold">Negotiation Specialist</span>
            <button type="button" className="px-3 py-1 rounded bg-white border text-gray-500 text-xs font-semibold">+ Add Certification</button>
          </div>
        </div>
      </form>
    </div>
  );
}
