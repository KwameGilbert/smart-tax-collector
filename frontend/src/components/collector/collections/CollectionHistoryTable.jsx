import React from "react";

const collections = [
  {
    id: "PAY-2023-1024",
    business: "Adwoa Grocery Shop",
    businessId: "BUS-2023-001",
    taxType: "Business Operating Permit",
    taxCode: "TAX-001",
    amount: "GHS 200.00",
    date: "12 Jul, 2023",
    time: "09:25 AM",
    paymentMethod: "Cash",
    receipt: "RCP 2023 5642",
  },
  {
    id: "PAY-2023-1023",
    business: "Afia Restaurant",
    businessId: "BUS-2023-002",
    taxType: "Food & Beverage License",
    taxCode: "TAX-002",
    amount: "GHS 150.00",
    date: "12 Jul, 2023",
    time: "09:21 AM",
    paymentMethod: "MOMO",
    receipt: "RCP 2023 5641",
  },
  {
    id: "PAY-2023-1022",
    business: "Ama Fashion Boutique",
    businessId: "BUS-2023-003",
    taxType: "Signage Fee",
    taxCode: "TAX-005",
    amount: "GHS 75.00",
    date: "12 Jul, 2023",
    time: "08:54 AM",
    paymentMethod: "Cash",
    receipt: "RCP 2023 5640",
  },
  {
    id: "PAY-2023-1021",
    business: "Kofi Auto Repairs",
    businessId: "BUS-2023-004",
    taxType: "Business Operating Permit",
    taxCode: "TAX-001",
    amount: "GHS 225.00",
    date: "12 Jul, 2023",
    time: "08:43 AM",
    paymentMethod: "Cash",
    receipt: "RCP 2023 5639",
  },
];

const paymentColors = {
  Cash: "bg-green-100 text-green-600",
  MOMO: "bg-blue-100 text-blue-600",
  Card: "bg-purple-100 text-purple-600",
};

export default function CollectionHistoryTable() {
  return (
    <div className="bg-white rounded-lg shadow border border-gray-100 mt-6">
      <div className="px-6 pt-4 pb-2 text-lg font-semibold text-gray-700">
        Collection History
      </div>
      <div className="overflow-x-auto">
        <table className="min-w-full text-sm">
          <thead>
            <tr className="bg-gray-50 text-gray-500">
              <th className="px-6 py-3 text-left font-medium">
                TRANSACTION ID
              </th>
              <th className="px-6 py-3 text-left text-[12px] font-medium">BUSINESS</th>
              <th className="px-6 py-3 text-left text-[12px] font-medium">TAX TYPE</th>
              <th className="px-6 py-3 text-left text-[12px] font-medium">AMOUNT</th>
              <th className="px-6 py-3 text-left text-[12px] font-medium">DATE</th>
              <th className="px-6 py-3 text-left text-[12px] font-medium">
                PAYMENT METHOD
              </th>
              <th className="px-6 py-3 text-left text-[12px] font-medium">RECEIPT</th>
              <th className="px-6 py-3 text-left text-[12px] font-medium">ACTIONS</th>
            </tr>
          </thead>
          <tbody>
            {collections.map((row) => (
              <tr
                key={row.id}
                className="border-b last:border-b-0 hover:bg-gray-50"
              >
                <td className="px-6 py-3 text-[12px] font-medium text-gray-700">
                  {row.id}
                </td>
                <td className="px-6 py-3 text-[12px]">
                  <div className="flex items-center gap-2">
                    <span className="bg-green-100 text-green-600 rounded-full px-2 py-1 text-xs font-bold">
                      {row.business[0]}
                    </span>
                    <div>
                      <div className="font-semibold text-gray-700 leading-tight">
                        {row.business}
                      </div>
                      <div className="text-xs text-gray-400">
                        {row.businessId}
                      </div>
                    </div>
                  </div>
                </td>
                <td className="px-6 py-3 text-[12px]">
                  <div className="font-medium text-gray-700">{row.taxType}</div>
                  <div className="text-xs text-gray-400">{row.taxCode}</div>
                </td>
                <td className="px-6 py-3 text-[12px] font-bold text-gray-800">
                  {row.amount}
                </td>
                <td className="px-6 py-3">
                  <div className="text-gray-700">{row.date}</div>
                  <div className="text-xs text-gray-400">{row.time}</div>
                </td>
                <td className="px-6 py-3 text-[12px]">
                  <span
                    className={`rounded-full px-2 py-1 text-xs font-semibold ${
                      paymentColors[row.paymentMethod]
                    }`}
                  >
                    {row.paymentMethod}
                  </span>
                </td>
                <td className="px-6 py-3 text-[12px] text-gray-700">{row.receipt}</td>
                <td className="px-6 py-3 text-[12px]">
                  <div className="flex gap-2 text-lg text-gray-400">
                    <a
                      href={`/collector/view-taxpayers/${row.businessId}`}
                      className="ri-eye-line hover:text-blue-500 cursor-pointer"
                      title="View"
                    />
                  </div>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
      <div className="px-6 py-3 flex items-center justify-between text-xs text-gray-500 border-t bg-gray-50">
        <span>Showing 1 to 10 of 68 results</span>
        <div className="flex gap-1">
          {[1, 2, 3, 7].map((n, i) => (
            <button
              key={n}
              className={`px-2 py-1 rounded ${
                i === 0
                  ? "bg-green-100 text-green-600 font-bold"
                  : "hover:bg-gray-200"
              }`}
            >
              {n}
            </button>
          ))}
        </div>
      </div>
    </div>
  );
}
