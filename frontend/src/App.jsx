import { BrowserRouter, Route, Routes } from "react-router-dom";
import FinanceMainLayout from "./components/layout/MainLayout";
import FinanceDashboard from "./pages/financial/Dashboard";
import BusinessRegistry from "./pages/financial/BusinessRegistry";
import ViewRegisteredBusiness from "./pages/financial/ViewRegistedBusiness";
import RegisterBusinessForm from "./components/financial/BusinessRegistryForms";
import Notification from "./pages/financial/Notification";
import Home from "./pages/Home";
import PaymentManagement from "./pages/financial/PaymentManagement";
import CollectorsManagement from "./pages/financial/CollectorsManagement";
import FinanceLogin from "./pages/financial/Login";
import CollectorsMainLayout from "./components/collector/layout/MainLayout";
import CollectorDashboard from "./pages/collector/Dashboard";
import SearchBusiness from "./pages/collector/SearchBusiness";
import CollectPayment from "./pages/collector/CollectPayment";
import Reports from "./pages/financial/Reports";
import Settings from "./pages/financial/Settings";
import Performance from "./pages/collector/Performance";
import CollectorSettingsPage from "./pages/collector/Settings";
import Leaderboard from "./pages/collector/Leaderboard";
import Collections from "./pages/collector/Collections";

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/finance-login" element={<FinanceLogin />} />
        {/* THis is the finance dashboard */}
        <Route path="/finance" element={<FinanceMainLayout />}>
          <Route index element={<FinanceDashboard />} />
          <Route path="business-registry" element={<BusinessRegistry />} />
          <Route
            path="business-registry/view-registered-business/:id"
            element={<ViewRegisteredBusiness />}
          />
          <Route
            path="business-registry-forms"
            element={<RegisterBusinessForm />}
          />
          <Route path="notification-center" element={<Notification />} />
          <Route path="payment-management" element={<PaymentManagement />} />
          <Route
            path="collectors-management"
            element={<CollectorsManagement />}
          />
          <Route path="reports" element={<Reports />} />
          <Route path="settings" element={<Settings />} />
        </Route>

        {/* collectors Dashboard */}
        <Route path="/collector" element={<CollectorsMainLayout />}>
          <Route index element={<CollectorDashboard />} />
          <Route path="search-business" element={<SearchBusiness />} />
          <Route path="collect-payment" element={<CollectPayment />} />
          <Route path="performance" element={<Performance />} />
          <Route path="settings" element={<CollectorSettingsPage />} />
          <Route path="leaderboard" element={<Leaderboard />} />
          <Route path="collections" element={<Collections />} />
        </Route>
      </Routes>
    </BrowserRouter>
  );
}

export default App;
