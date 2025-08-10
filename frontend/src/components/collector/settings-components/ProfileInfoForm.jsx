import React, { useState } from "react";

export default function ProfileInfoForm() {
  const [photo, setPhoto] = useState(null);
  return (
    <div className="bg-white rounded-xl shadow p-6 border border-gray-100 flex-1">
      <h3 className="font-semibold text-lg mb-4 text-gray-800">Profile Information</h3>
      <p className="text-gray-500 text-sm mb-4">Update your personal information and profile details</p>
      <div className="flex items-center gap-4 mb-6">
        <div className="w-16 h-16 rounded-full bg-green-500 flex items-center justify-center text-2xl font-bold text-white">
          JS
        </div>
        <div>
          <label className="block mb-2 text-sm font-medium">Change Photo</label>
          <input type="file" accept="image/png,image/jpeg" className="block mb-1" />
          <span className="text-xs text-gray-400">JPG, PNG max 2MB</span>
        </div>
      </div>
      <form className="space-y-4">
        <div className="flex gap-4">
          <div className="flex-1">
            <label className="block text-sm font-medium mb-1">First Name</label>
            <input type="text" className="w-full border rounded p-2" value="John" />
          </div>
          <div className="flex-1">
            <label className="block text-sm font-medium mb-1">Last Name</label>
            <input type="text" className="w-full border rounded p-2" value="Smith" />
          </div>
        </div>
        <div>
          <label className="block text-sm font-medium mb-1">Email</label>
          <input type="email" className="w-full border rounded p-2" value="john.smith@taxdept.gov" />
        </div>
        <div>
          <label className="block text-sm font-medium mb-1">Phone Number</label>
          <input type="tel" className="w-full border rounded p-2" value="+1 (555) 123-4567" />
        </div>
        <div>
          <label className="block text-sm font-medium mb-1">Department</label>
          <select className="w-full border rounded p-2">
            <option>Collections</option>
            <option>Audit</option>
            <option>Support</option>
          </select>
        </div>
      </form>
    </div>
  );
}
