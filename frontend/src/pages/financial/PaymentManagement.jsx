import React from "react";
import PaymentsMetricsCards from "../../components/financial/PaymentsMetricsCards";
import PaymentCharts from "../../components/financial/charts/PaymentsChart";
import PaymentsTable from "../../components/financial/PaymentsTable";

const PaymentManagement = () => {
  return (
    <div>
      <div className="my-5">
        <h1 class="text-2xl font-bold">Payment Management</h1>
        <p class="text-gray-400">Track and manage all tax payments</p>
      </div>
      <div>
        <PaymentsMetricsCards/>
      </div>
      <div>
        <PaymentCharts/>
      </div>
      <div>
        <PaymentsTable/>
      </div>
    </div>
  );
};

export default PaymentManagement;
