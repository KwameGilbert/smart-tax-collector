
import React, { useState } from "react";
import { FiPhone, FiCreditCard, FiDollarSign, FiDatabase, FiCloud, FiDownload, FiEdit, FiEye } from "react-icons/fi";
import { Button } from "../../ui/button";

const paymentMethods = [
  { name: "Cash", icon: <FiDollarSign className="text-green-600" />, color: "bg-green-100 text-green-800" },
  { name: "Mobile Money", icon: <FiPhone className="text-yellow-500" />, color: "bg-yellow-100 text-yellow-800" },
  { name: "Bank Transfer", icon: <FiDatabase className="text-indigo-600" />, color: "bg-indigo-100 text-indigo-800" },
  { name: "Card Payment", icon: <FiCreditCard className="text-purple-600" />, color: "bg-purple-100 text-purple-800" },
];

// const dummyPayments = [
//   {
//     id: 1,
//     business: "Adwoa Grocery Shop",
//     amount: 200,
//     method: "MTN Mobile Money",
//     status: "Confirmed",
//     date: "2025-08-01",
//     collector: "John Anane",
//   },
//   {
//     id: 2,
//     business: "Kofi Auto Repairs",
//     amount: 250,
//     method: "Cash",
//     status: "Pending",
//     date: "2025-08-02",
//     collector: "Sarah Osei",
//   },
//   {
//     id: 3,
//     business: "Ama Fashion Boutique",
//     amount: 75,
//     method: "Bank Transfer",
//     status: "Cancelled",
//     date: "2025-08-03",
//     collector: "Michael Agyei",
//   },
// ];

export default function PaymentMethodsTab() {
  const [selected, setSelected] = useState(["Cash", "Mobile Money"]);
  const [showForm, setShowForm] = useState(false);
  const [apiStatus, setApiStatus] = useState({ mtn: "Online", vodafone: "Offline", airteltigo: "Online" });
  const [auditLog, setAuditLog] = useState([
    { action: "Enabled Mobile Money", user: "Admin", date: "2025-08-01 09:00" },
  ]);

  const toggleMethod = (method) => {
    setSelected(selected.includes(method)
      ? selected.filter(m => m !== method)
      : [...selected, method]);
  };

  const exportCSV = () => {
    // Dummy export logic
    alert("Exported payment methods to CSV!");
  };

  return (
    <div className="p-4 space-y-6">
      {/* Dashboard Cards */}
      <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
        {paymentMethods.map((pm) => (
          <div key={pm.name} className={`rounded-lg shadow p-4 flex items-center gap-3 ${pm.color}`}>
            <div className="text-2xl">{pm.icon}</div>
            <div>
              <div className="font-semibold">{pm.name}</div>
              <div className="text-xs">{selected.includes(pm.name) ? "Enabled" : "Disabled"}</div>
            </div>
            <button
              size="sm"
              className="ml-auto bg-white p-2 rounded-sm"
              variant={selected.includes(pm.name) ? "default" : "outline"}
              onClick={() => toggleMethod(pm.name)}
            >
              {selected.includes(pm.name) ? "Disable" : "Enable"}
            </button>
          </div>
        ))}
      </div>

      {/* API Status */}
      <div className="bg-white rounded-lg shadow p-4 flex flex-col md:flex-row gap-6 items-center">
        <div className="flex-1">
          <h4 className="font-semibold mb-2 flex items-center gap-2"><FiCloud /> API Status</h4>
          <div className="flex gap-4">
            <div className="flex items-center gap-2">
              <FiPhone className="text-yellow-500" />
              <span>MTN:</span>
              <span className={apiStatus.mtn === "Online" ? "text-green-600" : "text-red-600"}>{apiStatus.mtn}</span>
            </div>
            <div className="flex items-center gap-2">
              <FiPhone className="text-red-500" />
              <span>Vodafone:</span>
              <span className={apiStatus.vodafone === "Online" ? "text-green-600" : "text-red-600"}>{apiStatus.vodafone}</span>
            </div>
            <div className="flex items-center gap-2">
              <FiPhone className="text-blue-500" />
              <span>AirtelTigo:</span>
              <span className={apiStatus.airteltigo === "Online" ? "text-green-600" : "text-red-600"}>{apiStatus.airteltigo}</span>
            </div>
          </div>
        </div>
        <div>
          <Button variant="outline" size="sm" onClick={exportCSV} className="flex items-center gap-2"><FiDownload /> Export CSV</Button>
        </div>
      </div>

      {/* Payment Methods Table */}
      {/* <div className="bg-white rounded-lg shadow p-4">
        <div className="flex justify-between items-center mb-3">
          <h4 className="font-semibold">Recent Payments</h4>
          <Button size="sm" variant="default" onClick={() => setShowForm(true)} className="flex items-center gap-2"><FiEdit /> Add Payment</Button>
        </div>
        <div className="overflow-x-auto">
          <table className="min-w-full divide-y divide-gray-200">
            <thead className="bg-gray-50">
              <tr>
                <th className="px-3 py-2 text-left text-xs font-medium text-gray-500">Business</th>
                <th className="px-3 py-2 text-left text-xs font-medium text-gray-500">Amount</th>
                <th className="px-3 py-2 text-left text-xs font-medium text-gray-500">Method</th>
                <th className="px-3 py-2 text-left text-xs font-medium text-gray-500">Status</th>
                <th className="px-3 py-2 text-left text-xs font-medium text-gray-500">Date</th>
                <th className="px-3 py-2 text-left text-xs font-medium text-gray-500">Collector</th>
                <th className="px-3 py-2 text-left text-xs font-medium text-gray-500">Actions</th>
              </tr>
            </thead>
            <tbody>
              {dummyPayments.map((p) => (
                <tr key={p.id} className="hover:bg-gray-50">
                  <td className="px-3 py-2 whitespace-nowrap">{p.business}</td>
                  <td className="px-3 py-2 whitespace-nowrap">GHS {p.amount}</td>
                  <td className="px-3 py-2 whitespace-nowrap">
                    <span className={`px-2 py-1 rounded-full text-xs font-medium ${paymentMethods.find(pm => pm.name === p.method)?.color || "bg-gray-100 text-gray-800"}`}>
                      {paymentMethods.find(pm => pm.name === p.method)?.icon} {p.method}
                    </span>
                  </td>
                  <td className={`px-3 py-2 whitespace-nowrap text-xs font-semibold ${p.status === "Confirmed" ? "text-green-700" : p.status === "Pending" ? "text-yellow-600" : "text-red-600"}`}>{p.status}</td>
                  <td className="px-3 py-2 whitespace-nowrap">{p.date}</td>
                  <td className="px-3 py-2 whitespace-nowrap">{p.collector}</td>
                  <td className="px-3 py-2 whitespace-nowrap flex gap-2">
                    <Button size="icon" variant="outline"><FiEye /></Button>
                    <Button size="icon" variant="outline"><FiEdit /></Button>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div> */}

      {/* Add Payment Modal */}
      {showForm && (
        <div className="fixed inset-0 bg-black/30 flex items-center justify-center z-50">
          <div className="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative">
            <button className="absolute top-2 right-2 text-gray-400 hover:text-gray-600" onClick={() => setShowForm(false)}>&times;</button>
            <h4 className="font-semibold mb-4">Add Payment</h4>
            <form className="space-y-3">
              <div>
                <label className="block text-sm font-medium mb-1">Business</label>
                <input type="text" className="w-full border rounded p-2" placeholder="Business Name" />
              </div>
              <div>
                <label className="block text-sm font-medium mb-1">Amount</label>
                <input type="number" className="w-full border rounded p-2" placeholder="Amount" />
              </div>
              <div>
                <label className="block text-sm font-medium mb-1">Method</label>
                <select className="w-full border rounded p-2">
                  {paymentMethods.map(pm => (
                    <option key={pm.name} value={pm.name}>{pm.name}</option>
                  ))}
                </select>
              </div>
              <div>
                <label className="block text-sm font-medium mb-1">Status</label>
                <select className="w-full border rounded p-2">
                  <option value="Confirmed">Confirmed</option>
                  <option value="Pending">Pending</option>
                  <option value="Cancelled">Cancelled</option>
                </select>
              </div>
              <div>
                <label className="block text-sm font-medium mb-1">Date</label>
                <input type="date" className="w-full border rounded p-2" />
              </div>
              <div>
                <label className="block text-sm font-medium mb-1">Collector</label>
                <input type="text" className="w-full border rounded p-2" placeholder="Collector Name" />
              </div>
              <div className="flex justify-end gap-2 pt-2">
                <Button type="button" variant="outline" onClick={() => setShowForm(false)}>Cancel</Button>
                <Button type="submit" variant="default">Save</Button>
              </div>
            </form>
          </div>
        </div>
      )}

      {/* Audit Log */}
      <div className="bg-white rounded-lg shadow p-4">
        <h4 className="font-semibold mb-2 flex items-center gap-2"><FiDatabase /> Audit Log</h4>
        <ul className="list-disc pl-6 text-sm flex flex-col gap-3">
          {auditLog.map((log, idx) => (
            <li key={idx}><span className="font-medium">{log.action}</span> by {log.user} on {log.date}</li>
          ))}
        </ul>
      </div>
    </div>
  );
}
