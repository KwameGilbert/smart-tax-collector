import React from 'react'
import { Search, ClipboardList, FileText, BarChart } from "lucide-react";

const QuickActions = () => {
  return (
    <div>
      <h2 className="text-lg font-bold mb-2">Quick Actions</h2>
        <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6">
          <div className="bg-white p-4 rounded shadow hover:shadow-md transition cursor-pointer flex flex-col items-center text-center hover:bg-green-50 hover:border hover:border-green-200">
            <div className="bg-green-100 flex items-center justify-center w-12 h-12 rounded-full mb-3">
              <Search className="text-green-600" />
            </div>
            <p className="font-semibold">Search Business</p>
            <p className="text-xs text-gray-500">
              Find businesses to collect from
            </p>
          </div>
          <div className="bg-white p-4 rounded shadow hover:shadow-md transition cursor-pointer flex flex-col items-center text-center hover:bg-blue-50 hover:border hover:border-blue-200">
            <div className="bg-blue-100 flex items-center justify-center w-12 h-12 rounded-full mb-3">
              <ClipboardList className="text-blue-600 mb-2" />
            </div>
            <p className="font-semibold">Start Collection</p>
            <p className="text-xs text-gray-500">Begin a new tax collection</p>
          </div>
          <div className="bg-white p-4 rounded shadow hover:shadow-md transition cursor-pointer flex flex-col items-center text-center hover:bg-orange-50 hover:border hover:border-orange-200">
            <div className="bg-orange-100 flex items-center justify-center w-12 h-12 rounded-full mb-3">
              <FileText className="text-orange-600" />
            </div>
            <p className="font-semibold">Recent Receipts</p>
            <p className="text-xs text-gray-500">
              View or print recent receipts
            </p>
          </div>
          <div className="bg-white p-4 rounded shadow hover:shadow-md transition cursor-pointer flex flex-col items-center text-center hover:bg-purple-50 hover:border hover:border-purple-200">
            <div className="bg-purple-100 flex items-center justify-center w-12 h-12 rounded-full mb-3">
              <BarChart className="text-purple-600" />
            </div>
            <p className="font-semibold">My Performance</p>
            <p className="text-xs text-gray-500">
              Track your collection metrics
            </p>
          </div>
        </div>
    </div>
  )
}

export default QuickActions
