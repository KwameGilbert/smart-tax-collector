
import React, { useState } from "react";
import { FiUser, FiEdit, FiLock, FiShield, FiDownload, FiMail, FiPhone, FiEye } from "react-icons/fi";
import { Button } from "../../ui/button";

const dummyUser = {
  name: "Gilbert Elikplim Kukah",
  email: "gilbert.kukah@example.com",
  phone: "+233541436414",
  role: "Finance Admin",
  avatar: "https://ui-avatars.com/api/?name=Gilbert+Kukah&background=6D28D9&color=fff&size=128",
};

const dummyActivityLog = [
  { action: "Logged in", date: "2025-08-10 08:00", ip: "192.168.1.10" },
  { action: "Changed password", date: "2025-08-09 18:30", ip: "192.168.1.10" },
];

export default function UserProfileTab() {
  const [editMode, setEditMode] = useState(false);
  const [user, setUser] = useState(dummyUser);
  const [show2FA, setShow2FA] = useState(false);
  const [privacy, setPrivacy] = useState({ email: true, phone: true });

  const handleEdit = () => setEditMode(true);
  const handleSave = () => setEditMode(false);
  const handleChange = (e) => setUser({ ...user, [e.target.name]: e.target.value });
  const handle2FAToggle = () => setShow2FA(!show2FA);
  const handlePrivacyChange = (type) => setPrivacy({ ...privacy, [type]: !privacy[type] });
  const handleExport = () => alert("Exported profile data!");

  return (
    <div className="p-4 space-y-6">
      {/* Profile Card */}
      <div className="bg-white rounded-lg shadow p-4 flex flex-col md:flex-row gap-6 items-center">
        <img src={user.avatar} alt="Avatar" className="w-24 h-24 rounded-full border-4 border-purple-200" />
        <div className="flex-1">
          <div className="font-semibold text-lg flex items-center gap-2">{user.name} <span className="text-xs px-2 py-1 bg-purple-100 text-purple-700 rounded-full">{user.role}</span></div>
          <div className="text-sm flex items-center gap-2"><FiMail /> {user.email}</div>
          <div className="text-sm flex items-center gap-2"><FiPhone /> {user.phone}</div>
        </div>
        <Button variant="outline" size="sm" className="flex items-center gap-2" onClick={handleEdit}><FiEdit /> Edit</Button>
        <Button variant="outline" size="sm" className="flex items-center gap-2" onClick={handleExport}><FiDownload /> Export</Button>
      </div>

      {/* Edit Form Modal */}
      {editMode && (
        <div className="fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center z-50">
          <div className="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative">
            <button className="absolute top-2 right-2 text-gray-400 hover:text-gray-600" onClick={handleSave}>&times;</button>
            <h4 className="font-semibold mb-4">Edit Profile</h4>
            <form className="space-y-3">
              <div>
                <label className="block text-sm font-medium mb-1">Name</label>
                <input type="text" name="name" value={user.name} onChange={handleChange} className="w-full border rounded p-2" />
              </div>
              <div>
                <label className="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" value={user.email} onChange={handleChange} className="w-full border rounded p-2" />
              </div>
              <div>
                <label className="block text-sm font-medium mb-1">Phone</label>
                <input type="tel" name="phone" value={user.phone} onChange={handleChange} className="w-full border rounded p-2" />
              </div>
              <div className="flex justify-end gap-2 pt-2">
                <Button type="button" variant="outline" onClick={handleSave}>Cancel</Button>
                <Button type="submit" variant="default" onClick={handleSave}>Save</Button>
              </div>
            </form>
          </div>
        </div>
      )}

      {/* Security & 2FA */}
      <div className="bg-white rounded-lg shadow p-4 flex flex-col md:flex-row gap-6 items-center">
        <div className="flex-1">
          <h4 className="font-semibold mb-2 flex items-center gap-2"><FiLock /> Security</h4>
          <Button variant="outline" size="sm" className="flex items-center gap-2" onClick={handle2FAToggle}><FiShield /> {show2FA ? "Disable" : "Enable"} 2FA</Button>
        </div>
        <div className="flex-1">
          <h4 className="font-semibold mb-2 flex items-center gap-2"><FiEye /> Privacy Settings</h4>
          <div className="flex gap-4">
            <label className="flex items-center gap-2">
              <input type="checkbox" checked={privacy.email} onChange={() => handlePrivacyChange("email")} /> Show Email
            </label>
            <label className="flex items-center gap-2">
              <input type="checkbox" checked={privacy.phone} onChange={() => handlePrivacyChange("phone")} /> Show Phone
            </label>
          </div>
        </div>
      </div>

      {/* Activity Log */}
      <div className="bg-white rounded-lg shadow p-4">
        <h4 className="font-semibold mb-2 flex items-center gap-2"><FiUser /> Activity Log</h4>
        <ul className="list-disc pl-6 text-sm">
          {dummyActivityLog.map((log, idx) => (
            <li key={idx}><span className="font-medium">{log.action}</span> on {log.date} (IP: {log.ip})</li>
          ))}
        </ul>
      </div>
    </div>
  );
}
