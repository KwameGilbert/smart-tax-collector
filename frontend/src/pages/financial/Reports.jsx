import PaymentCollectionsMethods from "@/components/financial/charts/PaymentCollectionsMethods";
import ReportsMonthlyRevenue from "@/components/financial/charts/ReportsMonthlyRevenue";
import ReportsMetricsCards from "@/components/financial/ReportsMetricsCards";
import React from "react";

const Reports = () => {
  return (
    <div>
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div>
          <h1 class="text-2xl font-bold">Reports & Analytics</h1>
          <p class="text-gray-600">
            View detailed reports and tax collection analytics
          </p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3">
          <button
            id="generate-report-btn"
            class="flex items-center justify-center gap-2 bg-blue-900 hover:bg-blue-800 text-white px-4 py-2 rounded-md shadow-sm"
          >
            <i class="ri-file-chart-line"></i>
            Generate New Report
          </button>
        </div>
      </div>

     <ReportsMetricsCards/>

     <div className="flex flex-col lg:flex-row gap-6 mt-5">
       <div className="flex-2">
        <ReportsMonthlyRevenue/>
       </div>
       <div className="flex-[1.5]">
         <PaymentCollectionsMethods/>
       </div>
     </div>
    </div>
  );
};

export default Reports;
