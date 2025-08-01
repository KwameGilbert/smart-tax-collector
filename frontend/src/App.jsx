import { BrowserRouter, Route, Routes } from "react-router-dom";
import FinanceMainLayout from "./components/layout/MainLayout";
import FinanceDashboard from "./pages/financial/Dashboard";
import BusinessRegistry from "./pages/financial/BusinessRegistry";
import ViewRegisteredBusiness from "./pages/financial/ViewRegistedBusiness";
import RegisterBusinessForm from "./components/financial/BusinessRegistryForms";
import Notification from "./pages/financial/Notification";
import Home from "./pages/Home";
function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Home/>}/>
        <Route path="/finance" element={<FinanceMainLayout/>}>
          <Route index element={<FinanceDashboard/>} />
          <Route path="business-registry" element={<BusinessRegistry/>} />
          <Route path="business-registry/view-registered-business/:id" element={<ViewRegisteredBusiness/>} />
          <Route path="business-registry-forms" element={<RegisterBusinessForm/>} />
          <Route path="notification-center" element={<Notification/>} />
        </Route>
      </Routes>
    </BrowserRouter>
  );
}

export default App;
