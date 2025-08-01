import React from "react";
// import { Progress } from "@/components/ui/progress";
import { Search, ClipboardList, FileText, BarChart } from "lucide-react";
import CollectorMetricCards from "../../components/collector/DashboardMetricsCards";

const CollectorDashboard = () => {
  return (
    <div className="">
     
      {/* Main Content */}
      <main className="flex-1 p-6">
        <h2 className="text-2xl font-bold mb-1">Welcome back, John!</h2>
        <p className="mb-4 text-gray-600">
          Here's your tax collection summary for today
        </p>

        <div>
          <CollectorMetricCards/>
        </div>

        <h2 className="text-lg font-bold mb-2">Quick Actions</h2>
        <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6">
          <div className="bg-white p-4 rounded shadow hover:shadow-md transition cursor-pointer flex flex-col items-center text-center">
            <Search className="text-green-600 mb-2" />
            <p className="font-semibold">Search Business</p>
            <p className="text-xs text-gray-500">Find businesses to collect from</p>
          </div>
          <div className="bg-white p-4 rounded shadow hover:shadow-md transition cursor-pointer flex flex-col items-center text-center">
            <ClipboardList className="text-blue-600 mb-2" />
            <p className="font-semibold">Start Collection</p>
            <p className="text-xs text-gray-500">Begin a new tax collection</p>
          </div>
          <div className="bg-white p-4 rounded shadow hover:shadow-md transition cursor-pointer flex flex-col items-center text-center">
            <FileText className="text-green-600 mb-2" />
            <p className="font-semibold">Recent Receipts</p>
            <p className="text-xs text-gray-500">View or print recent receipts</p>
          </div>
          <div className="bg-white p-4 rounded shadow hover:shadow-md transition cursor-pointer flex flex-col items-center text-center">
            <BarChart className="text-purple-600 mb-2" />
            <p className="font-semibold">My Performance</p>
            <p className="text-xs text-gray-500">Track your collection metrics</p>
          </div>
        </div>

      
      </main>
    </div>
  );
};

export default CollectorDashboard;
