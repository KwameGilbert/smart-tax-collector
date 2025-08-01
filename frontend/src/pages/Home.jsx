import React from "react";
import { Link } from "react-router-dom";
import { User, Landmark } from "lucide-react";
import "remixicon/fonts/remixicon.css";

export default function Home() {
  return (
    <div className="min-h-screen bg-gradient-to-b from-[#eef8f1] to-[#f2f7ff] p-6 font-sans">
      {/* Header */}
      <header class="py-6 px-8">
        <div class="flex justify-between items-center max-w-7xl mx-auto">
          <div class="flex items-center">
            <div class="bg-white rounded-full p-2 shadow-md">
              <img
                src="assets/logo.png"
                alt="Sefwi Municipality Logo"
                class="h-12 w-12"
              />
            </div>
            <div class="ml-4">
              <h1 class="text-2xl font-bold text-gray-800">Sefwi Municipal</h1>
              <p class="text-gray-600">Tax Collection System</p>
            </div>
          </div>
        </div>
      </header>

      {/* Welcome */}
      <section className="text-center mb-14">
        <h2 class="text-4xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-[#16a34a] to-[#2563eb] bg-clip-text text-transparent">
          Welcome to Sefwi Tax Collection System
        </h2>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
          Select your dashboard to manage tax collections and municipal
          [#2563eb]s efficiently.
        </p>
      </section>

      {/* Dashboard Options */}
      <div className="grid md:grid-cols-3 gap-5 w-[96%] mx-auto">
        {/* Tax Collector Card */}
        <Link to="/tax-collector">
          <div className="bg-green-50 border-t-8 border-green-500 px-6 py-8 rounded-lg shadow-md">
            <div class="flex items-center justify-between mb-6">
              <div class="h-16 w-16 bg-[#22c55e]/20 rounded-full flex items-center justify-center text-[#16a34a]">
                <User size={35} />
              </div>
            </div>
            <h3 className="text-xl font-semibold text-gray-800 mb-2">
              Tax Collector
            </h3>
            <p className="text-gray-600 mb-4">
              Record tax collections, issue receipts, and manage your assigned
              zones and businesses.
            </p>
            <div className="flex flex-wrap gap-2">
              <span className="px-3 py-1 bg-[#22c55e]/10 text-[#16a34a] rounded-full text-xs">
                <i className="ri-money-dollar-box-line mr-1"></i> Collect
                Payments
              </span>
              <span className="px-3 py-1 bg-[#22c55e]/10 text-[#16a34a] rounded-full text-xs">
                <i className="ri-file-list-3-line mr-1"></i> Issue Receipts
              </span>
              <span className="px-3 py-1 bg-[#22c55e]/10 text-[#16a34a] rounded-full text-xs">
                <i className="ri-store-2-line mr-1"></i> Manage Businesses
              </span>
            </div>
          </div>
        </Link>

        {/* [#2563eb] Department Card */}
        <Link to="/finance">
          <div className="bg-blue-300/20 border-t-8 border-blue-600 px-6 py-8 rounded-lg shadow-md">
            <div class="flex items-center justify-between mb-6">
              <div class="h-16 w-16 bg-[#3b82f6]/20 rounded-full flex items-center justify-center text-[#2563eb]">
                <Landmark size={35} />
              </div>
            </div>
            <h3 className="text-xl font-semibold text-gray-800 mb-2">
              Finance Department
            </h3>
            <p className="text-gray-600 mb-4">
              Monitor tax collections, generate reports, and manage financial
              data and operations.
            </p>
            <div className="flex flex-wrap gap-2">
              <span className="px-3 py-1 bg-[#3b82f6]/10 text-[#2563eb] rounded-full text-xs">
                <i className="ri-line-chart-line mr-1"></i> View Analytics
              </span>
              <span className="px-3 py-1 bg-[#3b82f6]/10 text-[#2563eb] rounded-full text-xs">
                <i className="ri-file-chart-line mr-1"></i> Generate Reports
              </span>
              <span className="px-3 py-1 bg-[#3b82f6]/10 text-[#2563eb] rounded-full text-xs">
                <i className="ri-government-line mr-1"></i> Manage Tax Types
              </span>
            </div>
          </div>
        </Link>

        {/* executive Department Card */}
        <Link to="executive">
          <div className="bg-orange-100/20 border-t-8 border-orange-400 px-6 py-8 rounded-lg shadow-md">
            <div className="flex items-center justify-between mb-6">
              <div className="h-16 w-16 bg-orange-200/20 rounded-full flex items-center justify-center text-orange-600">
                <i className="ri-user-star-line text-3xl" />
              </div>
            </div>
            <h3 className="text-xl font-semibold text-gray-800 mb-2">
              Executive Department
            </h3>
            <p className="text-gray-600 mb-4">
              Monitor tax collections, generate reports, and manage financial
              data and operations.
            </p>
            <div className="flex flex-wrap gap-2">
              <span className="px-3 py-1 bg-orange-200/20 text-orange-500 rounded-full text-xs">
                <i className="ri-line-chart-line mr-1"></i> View Analytics
              </span>
              <span className="px-3 py-1 bg-orange-200/20 text-orange-500 rounded-full text-xs">
                <i className="ri-bar-chart-line mr-1"></i> View Summaries
              </span>
              <span className="px-3 py-1 bg-orange-200/20 text-orange-500 rounded-full text-xs">
                <i className="ri-file-download-line mr-1"></i> Export Data
              </span>
              <span className="px-3 py-1 bg-orange-200/20 text-orange-500 rounded-full text-xs">
              <i className="ri-file-chart-line mr-1"></i> Generate Report
              </span>
            </div>
          </div>
        </Link>
      </div>

      {/* Additional Resources */}
      <section className="mt-16 text-center">
        <h4 className="text-xl font-semibold text-gray-700 mb-6">
          Additional Resources
        </h4>
        <div className="grid grid-cols-2 sm:grid-cols-4 gap-6 justify-center">
          <div className="bg-white shadow rounded-xl p-4">
            <p className="text-purple-600 font-semibold">📘 User Guide</p>
          </div>
          <div className="bg-white shadow rounded-xl p-4">
            <p className="text-yellow-600 font-semibold">🎥 Tutorial Videos</p>
          </div>
          <div className="bg-white shadow rounded-xl p-4">
            <p className="text-pink-600 font-semibold">❓ FAQ</p>
          </div>
          <div className="bg-white shadow rounded-xl p-4">
            <p className="text-green-600 font-semibold">🛟 Support</p>
          </div>
        </div>
      </section>
    </div>
  );
}
