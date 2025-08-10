import React, { useState } from "react";
import {
  FaMapMarkerAlt,
  FaEdit,
  FaTrash,
  FaEye,
  FaChevronDown,
  FaChevronRight,
  FaChartBar,
  FaInfoCircle,
  FaPlus,
} from "react-icons/fa";
import { Button } from "../../ui/button";
import { Input } from "../../ui/input";

const initialZones = [
  {
    name: "Central Zone",
    code: "CZ001",
    region: "Central",
    manager: "John Doe",
    status: true,
  },
  {
    name: "North District",
    code: "ND002",
    region: "Northern",
    manager: "Jane Smith",
    status: false,
  },
];

const hierarchy = [
  {
    name: "Central Region",
    children: [
      {
        name: "Central Zone",
        children: [{ name: "Sub-district 1" }, { name: "Sub-district 2" }],
      },
    ],
  },
  {
    name: "Northern Region",
    children: [
      {
        name: "North District",
        children: [{ name: "Sub-district A" }],
      },
    ],
  },
];

export default function ZonalsTab() {
  const [zones, setZones] = useState(initialZones);
  const [expanded, setExpanded] = useState({});
  const [showForm, setShowForm] = useState(false);
  const [form, setForm] = useState({
    name: "",
    code: "",
    region: "",
    manager: "",
    status: true,
  });
  const [selectedZone, setSelectedZone] = useState(null);

  // Toggle hierarchy
  const toggleExpand = (name) =>
    setExpanded({ ...expanded, [name]: !expanded[name] });

  // Add/Edit Zone
  const openForm = (zone = null) => {
    setSelectedZone(zone);
    setForm(
      zone || { name: "", code: "", region: "", manager: "", status: true }
    );
    setShowForm(true);
  };
  const closeForm = () => setShowForm(false);
  const handleFormChange = (e) =>
    setForm({ ...form, [e.target.name]: e.target.value });
  const saveZone = () => {
    let updated;
    if (selectedZone) {
      updated = zones.map((z) => (z.code === selectedZone.code ? form : z));
    } else {
      updated = [...zones, form];
    }
    setZones(updated);
    closeForm();
  };
  const deleteZone = (code) => setZones(zones.filter((z) => z.code !== code));
  const toggleStatus = (code) =>
    setZones(
      zones.map((z) => (z.code === code ? { ...z, status: !z.status } : z))
    );

  return (
    <div className="p-2 md:p-4">
      <div className="flex items-center justify-between">
        {/* Breadcrumb */}
        <div className="flex items-center gap-2 text-sm text-blue-700">
          <span>Admin</span> <span className="mx-1">/</span>{" "}
          <span>Settings</span> <span className="mx-1">/</span>{" "}
          <span>Zonals</span>
        </div>
        {/* Add Zone Button */}
        <div className="">
          <button onClick={() => openForm()} className="bg-blue-600 text-white flex items-center gap-3 py-2 px-4 rounded-sm">
            <FaPlus /> Add Zone
          </button>
        </div>
      </div>
      {/* Interactive Map Placeholder */}
      <div className="mb-6">
        <div className="font-semibold mb-2 flex items-center gap-2">
          <FaMapMarkerAlt /> Interactive Map
        </div>
        <div className="bg-purple-50 rounded-lg h-48 flex items-center justify-center text-blue-500">
          [Map Component Here]
        </div>
      </div>
      {/* Zone Performance Dashboard Placeholder */}
      <div className="mb-6">
        <div className="font-semibold mb-2 flex items-center gap-2">
          <FaChartBar /> Zone Performance Dashboard
        </div>
        <div className="bg-purple-50 rounded-lg h-32 flex items-center justify-center text-blue-500">
          [Charts & Graphs Here]
        </div>
      </div>
      {/* Table/List View */}
      <div className="mb-6 overflow-x-auto rounded-lg shadow">
        <table className="min-w-full bg-white">
          <thead className="bg-purple-50">
            <tr>
              <th className="px-3 py-2 text-left">Name</th>
              <th className="px-3 py-2 text-left">Code</th>
              <th className="px-3 py-2 text-left">Region</th>
              <th className="px-3 py-2 text-left">Manager</th>
              <th className="px-3 py-2 text-left">Status</th>
              <th className="px-3 py-2 text-left">Actions</th>
            </tr>
          </thead>
          <tbody>
            {zones.map((z) => (
              <tr key={z.code} className="border-b">
                <td className="px-3 py-2">{z.name}</td>
                <td className="px-3 py-2">{z.code}</td>
                <td className="px-3 py-2">{z.region}</td>
                <td className="px-3 py-2">{z.manager}</td>
                <td className="px-3 py-2">
                  <Button
                    size="sm"
                    onClick={() => toggleStatus(z.code)}
                    className={
                      z.status
                        ? "bg-green-100 text-green-700"
                        : "bg-gray-100 text-gray-500"
                    }
                  >
                    {z.status ? "Enabled" : "Disabled"}
                  </Button>
                </td>
                <td className="px-3 py-2 flex gap-2">
                  <button
                    size="sm"
                    onClick={() => openForm(z)}
                    className=" text-blue-700 focus:outline-none"
                  >
                    <FaEdit />
                  </button>
                  <button
                    size="sm"
                    onClick={() => deleteZone(z.code)}
                    className=" text-red-700 focus:outline-none"
                  >
                    <FaTrash />
                  </button>
                  <button
                    size="sm"
                    className=" text-blue-700 focus:outline-none"
                  >
                    <FaEye />
                  </button>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
      {/* Zone Hierarchy View */}
      <div className="mb-6">
        <div className="font-semibold mb-2 flex items-center gap-2">
          <FaInfoCircle /> Zone Hierarchy
        </div>
        <div className="bg-purple-50 rounded-lg p-4">
          {hierarchy.map((region) => (
            <div key={region.name}>
              <button
                className="flex items-center gap-2 font-semibold text-blue-700 mb-2"
                onClick={() => toggleExpand(region.name)}
              >
                {expanded[region.name] ? <FaChevronDown /> : <FaChevronRight />}{" "}
                {region.name}
              </button>
              {expanded[region.name] &&
                region.children.map((zone) => (
                  <div key={zone.name} className="ml-6">
                    <button
                      className="flex items-center gap-2 text-blue-600 mb-1"
                      onClick={() => toggleExpand(zone.name)}
                    >
                      {expanded[zone.name] ? (
                        <FaChevronDown />
                      ) : (
                        <FaChevronRight />
                      )}{" "}
                      {zone.name}
                    </button>
                    {expanded[zone.name] &&
                      zone.children &&
                      zone.children.map((sub) => (
                        <div key={sub.name} className="ml-10 text-purple-500">
                          {sub.name}
                        </div>
                      ))}
                  </div>
                ))}
            </div>
          ))}
        </div>
      </div>
      {/* Population/Business Data Form */}
      <div className="mb-6">
        <div className="font-semibold mb-2">Population/Business Data Input</div>
        <form className="flex flex-wrap gap-2 items-center">
          <Input placeholder="Zone Name" className="w-40" />
          <Input placeholder="Population" type="number" className="w-32" />
          <Input placeholder="Businesses" type="number" className="w-32" />
          <Button className="bg-blue-600 text-white">Save Data</Button>
        </form>
      </div>

      {/* Modal for Add/Edit Zone */}
      {showForm && (
        <div className="fixed inset-0 bg-black/30 flex items-center justify-center z-50">
          <div className="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative">
            <button
              className="absolute top-2 right-2 text-gray-400 hover:text-red-500"
              onClick={closeForm}
            >
              ×
            </button>
            <h3 className="font-semibold mb-4">
              {selectedZone ? "Edit" : "Add"} Zone
            </h3>
            <form
              className="space-y-3"
              onSubmit={(e) => {
                e.preventDefault();
                saveZone();
              }}
            >
              <Input
                name="name"
                value={form.name}
                onChange={handleFormChange}
                placeholder="Zone Name"
                required
              />
              <Input
                name="code"
                value={form.code}
                onChange={handleFormChange}
                placeholder="Code"
                required
              />
              <Input
                name="region"
                value={form.region}
                onChange={handleFormChange}
                placeholder="Region"
                required
              />
              <Input
                name="manager"
                value={form.manager}
                onChange={handleFormChange}
                placeholder="Assigned Manager"
              />
              <div className="flex items-center gap-2">
                <span>Status:</span>
                <select
                  name="status"
                  value={form.status}
                  onChange={handleFormChange}
                  className="border rounded px-2 py-1"
                >
                  <option value={true}>Enabled</option>
                  <option value={false}>Disabled</option>
                </select>
              </div>
              <div className="flex justify-end gap-2 mt-4">
                <Button type="submit" className="bg-blue-600 text-white">
                  Save
                </Button>
                <Button
                  type="button"
                  onClick={closeForm}
                  className="bg-gray-100 text-gray-700"
                >
                  Cancel
                </Button>
              </div>
            </form>
          </div>
        </div>
      )}
    </div>
  );
}
