import React, { useEffect, useState } from "react";
import axios from "axios";

const TaxTypeList = () => {
  const [taxTypes, setTaxTypes] = useState([]);

  useEffect(() => {
    // Replace this URL with your actual JSON or API endpoint
    axios.get("/assets/data/taxtypes.json")
      .then((res) => setTaxTypes(res.data))
      .catch((err) => console.error("Error loading tax types:", err));
  }, []);

  // Get max amount for progress width calculation
  const maxAmount = Math.max(...(taxTypes.map(t => t.amount)), 1); // avoid 0 division

  return (
    <div className="">
      <h2 className="text-lg font-semibold mb-4">Most Collected Tax Types</h2>
      {taxTypes.map((type, index) => {
        const progressWidth = (type.amount / maxAmount) * 100;

        return (
          <div key={index} className="mb-6">
            <div className="flex justify-between items-center mb-1">
              <span className="font-medium text-gray-700 text-sm">{type.name}</span>
              <span className="font-semibold text-gray-800 text-sm">
                GHS {type.amount.toLocaleString(undefined, { minimumFractionDigits: 2 })}
              </span>
            </div>
            <div className="w-full bg-gray-200 rounded-full h-2 mb-1">
              <div
                className="h-2 rounded-full bg-gradient-to-r from-green-500 to-blue-500"
                style={{ width: `${progressWidth}%` }}
              />
            </div>
            <p className="text-sm text-gray-500">{type.count} collections</p>
          </div>
        );
      })}
    </div>
  );
};

export default TaxTypeList;
