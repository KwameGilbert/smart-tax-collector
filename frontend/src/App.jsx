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

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Home/>}/>
        <Route path="/finance-login" element={<FinanceLogin/>}/>
        <Route path="/finance" element={<FinanceMainLayout/>}>
          <Route index element={<FinanceDashboard/>} />
          <Route path="business-registry" element={<BusinessRegistry/>} />
          <Route path="business-registry/view-registered-business/:id" element={<ViewRegisteredBusiness/>} />
          <Route path="business-registry-forms" element={<RegisterBusinessForm/>} />
          <Route path="notification-center" element={<Notification/>} />
          <Route path="payment-management" element={<PaymentManagement/>}/>
          <Route path="collectors-management" element={<CollectorsManagement/>}/>
        </Route>

        {/* collectors Dashboard */}
        <Route path="/collector" element={<CollectorsMainLayout/>}>
          <Route index element={<CollectorDashboard/>}/>
          <Route path="search-business" element={<SearchBusiness/>}/>
        </Route>
      </Routes>
    </BrowserRouter>
  );
}

export default App;
