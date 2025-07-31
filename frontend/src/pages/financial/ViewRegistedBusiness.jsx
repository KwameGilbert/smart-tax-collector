import React, { useEffect, useState } from "react";
import { useParams, Link } from "react-router-dom";
import axios from "axios";
import { RiArrowLeftLine, RiPencilLine } from "react-icons/ri";

const ViewRegisteredBusiness = () => {
  const { id } = useParams();
  const [business, setBusiness] = useState(null);

  useEffect(() => {
    axios
      .get("/assets/data/businessregistry.json") 
      .then((res) => {
        const found = res.data.find((b) => b.id === parseInt(id));
        setBusiness(found);
      })
      .catch((err) => console.error("Failed to fetch business data", err));
  }, [id]);

  if (!business) {
    return (
      <div className="text-center mt-10 text-gray-600 text-lg">
        Loading business details...
      </div>
    );
  }

  return (
    <div className="max-w-3xl mx-auto p-6 bg-white rounded-xl shadow mt-6">
      <div className="flex justify-between items-center mb-6">
        <Link
          to="/business-registry"
          className="flex items-center text-blue-600 hover:underline"
        >
          <RiArrowLeftLine className="mr-1 text-lg" />
          Back to Registry
        </Link>
        <Link
          to={`/businesses/edit/${business.id}`}
          className="text-indigo-600 hover:text-indigo-800 text-lg"
        >
          <RiPencilLine className="inline mr-1" />
          Edit
        </Link>
      </div>

      <h2 className="text-2xl font-bold mb-4 text-gray-800">
        {business.name}
      </h2>

      <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-700">
        <div>
          <p className="font-semibold">Owner Name:</p>
          <p>{business.owner_name}</p>
        </div>
        <div>
          <p className="font-semibold">Contact:</p>
          <p>{business.contact}</p>
        </div>
        <div>
          <p className="font-semibold">Location:</p>
          <p>{business.location}</p>
        </div>
        <div>
          <p className="font-semibold">Business Type:</p>
          <p>{business.business_type}</p>
        </div>
        <div>
          <p className="font-semibold">Registration Date:</p>
          <p>{new Date(business.registration_date).toLocaleDateString()}</p>
        </div>
        <div>
          <p className="font-semibold">Status:</p>
          <span
            className={`inline-block px-3 py-1 text-sm rounded-full ${
              business.status === "active"
                ? "bg-green-100 text-green-800"
                : "bg-red-100 text-red-800"
            }`}
          >
            {business.status}
          </span>
        </div>
      </div>
    </div>
  );
};

export default ViewRegisteredBusiness;
