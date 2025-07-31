import React from "react";
import MetricsCards from "../../components/financial/MetricsCards";
import TaxDistributionChart from "../../components/financial/charts/TaxTypeDistributionChart";
import MonthlyRevenueChart from "../../components/financial/charts/MonthltTaxRevenue";
import RecentPayments from "../../components/financial/RecentPayment";

const FinanceDashboard = () => {
  return (
    <div>
      <MetricsCards />
      <div className="flex items-center gap-5 mb-5">
        <div className="flex-1">
          <TaxDistributionChart />
        </div>
        <div className="flex-1">
          <MonthlyRevenueChart />
        </div>
      </div>

      <RecentPayments/>
    </div>
  );
};

export default FinanceDashboard;
