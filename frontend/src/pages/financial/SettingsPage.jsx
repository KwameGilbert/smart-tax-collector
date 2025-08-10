import React, { useState } from "react";
import { FaListAlt, FaMapMarkedAlt, FaCreditCard, FaCog, FaUserCircle } from "react-icons/fa";
import TaxTypesTab from "../../components/financial/settings/TaxTypesTab";
import ZonalsTab from "../../components/financial/settings/ZonalsTab";
import PaymentMethodsTab from "../../components/financial/settings/PaymentMethodsTab";
import SystemSettingsTab from "../../components/financial/settings/SystemSettingsTab";
import UserProfileTab from "../../components/financial/settings/UserProfileTab";

const tabs = [
  { label: "Tax Types", icon: <FaListAlt />, component: <TaxTypesTab /> },
  { label: "Zonals", icon: <FaMapMarkedAlt />, component: <ZonalsTab /> },
  { label: "Payment Methods", icon: <FaCreditCard />, component: <PaymentMethodsTab /> },
  { label: "System Settings", icon: <FaCog />, component: <SystemSettingsTab /> },
  { label: "User Profile", icon: <FaUserCircle />, component: <UserProfileTab /> },
];


export default function SettingsPage() {
  const [activeTab, setActiveTab] = useState(0);
  return (
    <div className="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100 flex flex-col">
      <div className="max-w-5xl mx-auto w-full py-8 px-2 md:px-8">
        <div className="mb-6 flex items-center gap-2 text-sm text-blue-700">
          <span>Admin</span> <span className="mx-1">/</span> <span>Settings</span> <span className="mx-1">/</span> <span>{tabs[activeTab].label}</span>
        </div>
        <div className="bg-white rounded-2xl shadow-xl p-8 border border-blue-100">
          <div className="flex flex-wrap gap-2 border-b mb-8">
            {tabs.map((tab, idx) => (
              <button
                key={tab.label}
                className={`flex items-center gap-2 px-5 py-2 font-semibold border-b-2 rounded-t transition-colors focus:outline-none ${activeTab === idx ? "border-blue-600 text-blue-700 bg-blue-50 shadow" : "border-transparent text-gray-500 hover:bg-blue-50"}`}
                onClick={() => setActiveTab(idx)}
              >
                {tab.icon}
                {tab.label}
              </button>
            ))}
          </div>
          <div className="min-h-[400px] pb-24">
            {tabs[activeTab].component}
          </div>
        </div>
      </div>
      <div className="sticky bottom-0 w-full bg-gradient-to-r from-blue-50 to-blue-100 shadow-lg py-6 flex justify-center border-t border-blue-100">
        <button className="bg-blue-600 text-white px-10 py-3 rounded-xl font-bold shadow hover:bg-blue-700 transition-all duration-150">Save Changes</button>
      </div>
    </div>
  );
}
