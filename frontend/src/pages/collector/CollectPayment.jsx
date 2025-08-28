import React, { useState, useEffect } from "react";
import axios from "axios";
import { FiSearch, FiMapPin, FiUser } from "react-icons/fi";
import { IoIosPhonePortrait } from "react-icons/io";
import { MdQrCode2 } from "react-icons/md";

// Dummy taxes data for demonstration
const TAXES = [
  {
    name: "Business Operating Permit",
    description:
      "Annual permit for operating a business within the municipality",
    type: "Annual",
    lastPaid: "13 Jun, 2022",
    amount: "GHS 200.00",
  },
  {
    name: "Market Stall Fee",
    description: "Monthly fee for operating a stall in the market",
    type: "Monthly",
    lastPaid: "30 Jun, 2022",
    amount: "GHS 50.00",
  },
  {
    name: "Signage Fee",
    description: "Annual fee for business signage or advertising",
    type: "Annual",
    lastPaid: "22 Sep, 2022",
    amount: "GHS 75.00",
  },
  {
    name: "Food & Beverage License",
    description: "License required for selling food and beverages",
    type: "Annual",
    lastPaid: "10 Aug, 2022",
    amount: "GHS 150.00",
  },
  {
    name: "Environmental Health Permit",
    description: "Permit ensuring compliance with health standards",
    type: "Annual",
    lastPaid: "05 Jul, 2022",
    amount: "GHS 120.00",
  },
];

export default function CollectPayment() {
  const [businesses, setBusinesses] = useState([]);
  const [search, setSearch] = useState("");
  const [selected, setSelected] = useState(null);
  const [step, setStep] = useState(1); // 1: Business, 2: Choose Tax, 3: Payment Details
  const [selectedTax, setSelectedTax] = useState(null);
  const [selectedYear, setSelectedYear] = useState("2023");
  const [paymentMethod, setPaymentMethod] = useState("MTN Mobile Money");
  const [phoneNumber, setPhoneNumber] = useState("");

  useEffect(() => {
    axios
      .get("/assets/data/businessgriddata.json")
      .then((res) => {
        setBusinesses(res.data);
      })
      .catch((err) => {
        console.error("Error fetching businesses:", err);
      });
  }, []);

  const filteredBusinesses = businesses.filter(
    (b) =>
      b.name.toLowerCase().includes(search.toLowerCase()) ||
      b.id.toLowerCase().includes(search.toLowerCase()) ||
      b.phone.includes(search)
  );

  // Find selected business details
  const selectedBusiness = businesses.find((b) => b.id === selected);

  return (
    <div className="p-6  min-h-screen flex flex-col">
      <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Collect Payment</h1>
        <p class="text-gray-600">Process tax payments from businesses</p>
      </div>
      {/* Steps Header */}
      <div className="flex items-center justify-between my-6">
        {["Business", "Choose Tax", "Payment Details", "Confirmation"].map(
          (stepName, idx) => (
            <div key={idx} className="flex items-center flex-1">
              <div className="flex flex-col items-center">
                <div
                  className={`w-12 h-12 rounded-full flex items-center justify-center border-2 ${
                    step === idx + 1
                      ? "bg-green-500 border-green-500 text-white"
                      : "border-gray-300 text-gray-500"
                  }`}
                >
                  {idx + 1}
                </div>
                <span className="mt-2 text-sm text-center">{stepName}</span>
              </div>
              {idx < 3 && (
                <div className="flex-1 border-t border-gray-300 mb-6"></div>
              )}
            </div>
          )
        )}
      </div>
      <div className="p-6 bg-white rounded-md shadow-md">
        {/* Step 1: Select Business */}
        {step === 1 && (
          <>
            <h1 className="text-lg font-semibold">Collect Payment</h1>
            <p className="text-gray-500 text-sm">
              Process tax payments from businesses
            </p>
            <div className="relative mt-4">
              <FiSearch className="absolute left-3 top-3 text-gray-400" />
              <input
                type="text"
                placeholder="Search by business name, ID, or phone..."
                value={search}
                onChange={(e) => setSearch(e.target.value)}
                className="pl-10 pr-4 py-2 border rounded-md w-full focus:ring focus:ring-green-300"
              />
            </div>
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6 flex-1">
              {filteredBusinesses.map((biz) => (
                <div
                  key={biz.id}
                  className={`border rounded-md p-4 flex flex-col justify-between ${
                    selected === biz.id
                      ? "border-green-500 shadow-lg"
                      : "border-gray-200"
                  }`}
                >
                  <div>
                    <h2 className="font-semibold text-lg">{biz.name}</h2>
                    <p className="text-sm text-gray-500">{biz.id}</p>
                    <div className="flex items-center mt-2 text-sm text-gray-600">
                      <FiUser className="mr-2" /> {biz.owner}
                    </div>
                    <div className="flex items-center mt-1 text-sm text-gray-600">
                      <IoIosPhonePortrait className="mr-2" /> {biz.phone}
                    </div>
                    <div className="flex items-center mt-1 text-sm text-gray-600">
                      <FiMapPin className="mr-2" /> {biz.location}
                    </div>
                  </div>
                  <button
                    onClick={() => setSelected(biz.id)}
                    className="mt-4 text-green-600 border border-green-500 rounded px-3 py-1 hover:bg-green-50"
                  >
                    Select →
                  </button>
                </div>
              ))}
            </div>
            <div className="border-t border-gray-300 mt-8 pt-6 text-center">
              <div className="flex flex-col items-center">
                <div className="bg-green-100 p-3 rounded-full mb-2">
                  <svg
                    className="w-6 h-6 text-green-600"
                    fill="none"
                    stroke="currentColor"
                    strokeWidth={2}
                    viewBox="0 0 24 24"
                  >
                    <path d="M4 4h4v4H4zM16 4h4v4h-4zM4 16h4v4H4zM16 16h4v4h-4z" />
                    <path d="M4 12h4v4H4zM16 12h4v4h-4zM10 4h4v4h-4zM10 16h4v4h-4z" />
                  </svg>
                </div>
                <p className="text-gray-600 text-sm">Scan Business QR Code</p>
                <p className="text-xs text-gray-400">
                  Quickly find a business by scanning their ID card or
                  certificate
                </p>
              </div>
            </div>
            <div className="flex justify-end mt-6">
              <button
                disabled={!selected}
                className={`px-6 py-2 rounded-md text-white text-sm font-medium ${
                  selected
                    ? "bg-green-600 hover:bg-green-700"
                    : "bg-gray-300 cursor-not-allowed"
                }`}
                onClick={() => setStep(2)}
              >
                Next →
              </button>
            </div>
          </>
        )}

        {/* Step 2: Choose Tax */}
        {step === 2 && selectedBusiness && (
          <div className="bg-white rounded-md shadow p-6">
            <h2 className="text-lg font-semibold mb-4">Select Tax Type</h2>
            <div className="flex items-center mb-4">
              <div className="bg-green-100 rounded-full p-2 mr-3">
                <FiUser className="text-green-600 w-6 h-6" />
              </div>
              <div>
                <div className="font-semibold">{selectedBusiness.name}</div>
                <div className="text-xs text-gray-500">
                  {selectedBusiness.id}
                </div>
                <div className="text-xs text-gray-400">
                  {selectedBusiness.location}
                </div>
              </div>
              <button
                className="ml-auto text-green-600 border border-green-500 rounded px-3 py-1 hover:bg-green-50"
                onClick={() => setStep(1)}
              >
                Change
              </button>
            </div>
            <div>
              <div className="mb-2 font-medium text-gray-700">
                Available Taxes
              </div>
              <div className="space-y-4">
                {TAXES.map((tax, idx) => (
                  <div
                    key={idx}
                    className={`border rounded-md p-4 flex items-center justify-between ${
                      selectedTax === idx ? "border-green-500" : ""
                    }`}
                    onClick={() => setSelectedTax(idx)}
                    style={{ cursor: "pointer" }}
                  >
                    <div>
                      <div className="font-semibold">{tax.name}</div>
                      <div className="text-xs text-gray-500">
                        {tax.description}
                      </div>
                      <div className="flex items-center mt-1">
                        <span className="text-xs bg-gray-100 px-2 py-0.5 rounded mr-2">
                          {tax.type}
                        </span>
                        <span className="text-xs bg-yellow-100 px-2 py-0.5 rounded text-yellow-800">
                          Last paid: {tax.lastPaid}
                        </span>
                      </div>
                    </div>
                    <div className="font-semibold text-green-600">
                      {tax.amount}
                    </div>
                  </div>
                ))}
              </div>
            </div>
            <div className="flex justify-end mt-6">
              <button
                className="px-6 py-2 rounded-md text-white text-sm font-medium bg-green-600 hover:bg-green-700"
                disabled={selectedTax === null}
                onClick={() => setStep(3)}
              >
                Next →
              </button>
            </div>
          </div>
        )}

        {/* Step 3: Payment Details */}
        {step === 3 && selectedBusiness && selectedTax !== null && (
          <div className="bg-white rounded-md shadow p-6">
            <h2 className="text-lg font-semibold mb-4">Payment Details</h2>
            <div className="flex items-center mb-4">
              <div className="font-semibold flex-1">
                <div>{selectedBusiness.name}</div>
                <div className="text-xs text-gray-500">
                  {selectedBusiness.id}
                </div>
              </div>
              <div className="flex-1">
                <div className="font-semibold">{TAXES[selectedTax].name}</div>
                <div className="text-xs text-gray-500">TAX 001</div>
              </div>
              <div className="font-semibold text-green-600">
                {TAXES[selectedTax].amount}
              </div>
            </div>
            <div className="mb-4">
              <div className="font-medium mb-2">Select Payment Period</div>
              <div className="flex gap-2">
                {["2023", "2022"].map((year) => (
                  <button
                    key={year}
                    className={`px-4 py-2 rounded border ${
                      selectedYear === year
                        ? "bg-green-600 text-white"
                        : "bg-white text-gray-700"
                    }`}
                    onClick={() => setSelectedYear(year)}
                  >
                    {year}
                  </button>
                ))}
              </div>
            </div>
            <div className="bg-green-50 p-4 rounded mb-4">
              <div className="flex justify-between">
                <span>Base Amount:</span>
                <span className="font-semibold">
                  {TAXES[selectedTax].amount}
                </span>
              </div>
              <div className="flex justify-between">
                <span>Periods:</span>
                <span className="font-semibold">1</span>
              </div>
              <div className="flex justify-between">
                <span>Total:</span>
                <span className="font-semibold text-green-600">
                  {TAXES[selectedTax].amount}
                </span>
              </div>
            </div>
            <div className="mb-4">
              <div className="font-medium mb-2">Select Payment Method</div>
              <div className="flex gap-2 mb-2">
                {["Mobile Money", "Cash", "Bank"].map(
                  (method) => {
                    let iconColor = "";
                    if (method === "Mobile Money")
                      iconColor = "text-yellow-500";
                    else if (method === "Cash")
                      iconColor = "text-red-500";
                    else if (method === "Bank")
                      iconColor = "text-blue-500";
                    return (
                      <button
                        key={method}
                        className={`flex-1 px-4 py-2 rounded border flex flex-col items-center ${
                          paymentMethod === method
                            ? "bg-green-100 border-green-500"
                            : "bg-white border-gray-300"
                        }`}
                        onClick={() => setPaymentMethod(method)}
                      >
                        <IoIosPhonePortrait
                          className={`mb-2 w-8 h-8 ${iconColor}`}
                        />
                        <span>{method}</span>
                      </button>
                    );
                  }
                )}
              </div>
              <input
                type="text"
                placeholder="e.g. 024 000 0000"
                value={phoneNumber}
                onChange={(e) => setPhoneNumber(e.target.value)}
                className="w-full border rounded px-4 py-2"
              />
              <div className="text-xs text-gray-400 mt-1">
                Enter the phone number associated with the mobile money account
              </div>
            </div>
            <div className="flex justify-end mt-6">
              <button
                className="px-6 py-2 rounded-md text-white text-sm font-medium bg-green-600 hover:bg-green-700"
                disabled={!phoneNumber}
                onClick={() => setStep(4)}
              >
                Process Payment →
              </button>
            </div>
          </div>
        )}
        {/* Step 4: Confirmation */}
        {step === 4 && selectedBusiness && selectedTax !== null && (
          <div className="flex flex-col items-center justify-center min-h-[60vh]">
            <div className="bg-green-100 rounded-full p-4 mb-4">
              <svg
                className="w-8 h-8 text-green-600"
                fill="none"
                stroke="currentColor"
                strokeWidth={2}
                viewBox="0 0 24 24"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  d="M5 13l4 4L19 7"
                />
              </svg>
            </div>
            <h2 className="text-xl font-semibold mb-2">Payment Successful!</h2>
            <div className="text-gray-500 mb-2">
              Transaction ID: PAY-2023-1025
            </div>
            <div className="bg-gray-50 rounded shadow p-6 mb-6 w-full max-w-3xl">
              <div className="font-semibold mb-2 text-center">
                Receipt Summary
              </div>
              <div className="grid grid-cols-2 gap-x-2 gap-y-1 text-sm">
                <div className="text-gray-500">Business:</div>
                <div className="font-semibold">{selectedBusiness.name}</div>
                <div className="text-gray-500">Tax Type:</div>
                <div className="font-semibold">{TAXES[selectedTax].name}</div>
                <div className="text-gray-500">Period:</div>
                <div className="font-semibold">{selectedYear}</div>
                <div className="text-gray-500">Payment Method:</div>
                <div className="font-semibold">{paymentMethod}</div>
                <div className="text-gray-500">Date:</div>
                <div className="font-semibold">09 Aug, 2025 10:32 AM</div>
                <div className="text-gray-500">Total:</div>
                <div className="font-semibold text-green-600">
                  {TAXES[selectedTax].amount}
                </div>
              </div>
              <div className="flex justify-center mt-6">
                <div className="bg-gray-100 rounded p-6">
                  <MdQrCode2 size={50} />
                </div>
              </div>
            </div>
            <div className="flex gap-2 mt-2">
              <button className="bg-green-600 text-white px-4 py-2 rounded flex items-center">
                <svg
                  className="w-4 h-4 mr-2"
                  fill="none"
                  stroke="currentColor"
                  strokeWidth={2}
                  viewBox="0 0 24 24"
                >
                  <path d="M8 17l4 4 4-4" />
                </svg>
                View Receipt
              </button>
              <button className="bg-gray-100 text-gray-700 px-4 py-2 rounded">
                Print Receipt
              </button>
              <button className="bg-blue-100 text-blue-700 px-4 py-2 rounded">
                SMS Receipt
              </button>
            </div>
            <div className="flex justify-center items-center gap-4 mt-6 text-green-700 text-sm">
              <button className="underline" onClick={() => setStep(1)}>
                Back to Dashboard
              </button>
              <span>|</span>
              <button className="underline" onClick={() => setStep(1)}>
                + New Collection
              </button>
            </div>
          </div>
        )}
      </div>
    </div>
  );
}
