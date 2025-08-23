import React, { useEffect, useState } from 'react';
import Swal from 'sweetalert2';
import { Link, useParams, useNavigate } from 'react-router-dom';
import axios from 'axios';

const EditBusinessRegistry = () => {
  const { id } = useParams();
  const navigate = useNavigate();
  const [formData, setFormData] = useState({
    name: '',
    registration_id: '',
    category: '',
    zone: '',
    phone: '',
    email: '',
    address: '',
    owner_name: '',
    owner_phone: '',
    owner_address: '',
  });
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    axios.get('/assets/data/businessregistry.json')
      .then(res => {
        const found = res.data.find(b => String(b.id) === String(id));
        if (found) {
          setFormData({
            name: found.name || '',
            registration_id: found.registration_id || '',
            category: found.category || '',
            zone: found.zone || '',
            phone: found.phone || '',
            email: found.email || '',
            address: found.address || '',
            owner_name: found.owner_name || '',
            owner_phone: found.owner_phone || '',
            owner_address: found.owner_address || '',
          });
        }
        setLoading(false);
      })
      .catch(() => setLoading(false));
  }, [id]);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData((prev) => ({
      ...prev,
      [name]: value,
    }));
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    Swal.fire({
      toast: true,
      position: 'top-end',
      icon: 'success',
      title: 'Business updated successfully!',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
    });
    navigate('/business-registry');
  };

  if (loading) {
    return <div className="text-center py-20 text-gray-500 text-lg">Loading business details...</div>;
  }

  return (
    <div className="max-w-6xl mx-auto p-6">
      <div className="flex items-center justify-between mb-6">
        <h2 className="text-2xl font-semibold">Edit Business Registration</h2>
        <Link to="/business-registry" className="text-blue-600 hover:underline">
          ← Back to Business Registry
        </Link>
      </div>

      <form onSubmit={handleSubmit} className="border border-gray-300 shadow-md rounded-lg p-6 space-y-8">
        {/* Business Info */}
        <div>
          <h3 className="text-xl font-bold mb-4">Business Information</h3>
          <div className="grid md:grid-cols-2 gap-4">
            <div>
              <label className="block text-sm font-medium mb-1">Business Name</label>
              <input
                type="text"
                name="name"
                value={formData.name}
                onChange={handleChange}
                required
                className="w-full border border-gray-300 rounded px-3 py-2"
              />
            </div>
            <div>
              <label className="block text-sm font-medium mb-1">Registration ID/TIN</label>
              <input
                type="text"
                name="registration_id"
                value={formData.registration_id}
                onChange={handleChange}
                required
                className="w-full border border-gray-300 rounded px-3 py-2"
              />
            </div>
            <div>
              <label className="block text-sm font-medium mb-1">Category</label>
              <select
                name="category"
                value={formData.category}
                onChange={handleChange}
                required
                className="w-full border border-gray-300 rounded px-3 py-2"
              >
                <option value="">Select...</option>
                <option value="retail">Retail</option>
                <option value="service">Service</option>
                <option value="manufacturing">Manufacturing</option>
                <option value="other">Other</option>
              </select>
            </div>
            <div>
              <label className="block text-sm font-medium mb-1">Zone</label>
              <select
                name="zone"
                value={formData.zone}
                onChange={handleChange}
                required
                className="w-full border border-gray-300 rounded px-3 py-2"
              >
                <option value="">Select...</option>
                <option value="zone1">Zone 1</option>
                <option value="zone2">Zone 2</option>
                <option value="zone3">Zone 3</option>
              </select>
            </div>
          </div>
        </div>

        {/* Contact Info */}
        <div>
          <h3 className="text-xl font-bold mb-4">Contact Information</h3>
          <div className="grid md:grid-cols-2 gap-4">
            <div>
              <label className="block text-sm font-medium mb-1">Phone Number</label>
              <input
                type="tel"
                name="phone"
                value={formData.phone}
                onChange={handleChange}
                required
                className="w-full border border-gray-300 rounded px-3 py-2"
              />
            </div>
            <div>
              <label className="block text-sm font-medium mb-1">Email Address</label>
              <input
                type="email"
                name="email"
                value={formData.email}
                onChange={handleChange}
                className="w-full border border-gray-300 rounded px-3 py-2"
              />
            </div>
            <div className="md:col-span-2">
              <label className="block text-sm font-medium mb-1">Business Address</label>
              <textarea
                name="address"
                rows="2"
                value={formData.address}
                onChange={handleChange}
                required
                className="w-full border border-gray-300 rounded px-3 py-2"
              ></textarea>
            </div>
          </div>
        </div>

        {/* Owner Info */}
        <div>
          <h3 className="text-xl font-bold mb-4">Owner Information</h3>
          <div className="grid md:grid-cols-2 gap-4">
            <div>
              <label className="block text-sm font-medium mb-1">Owner's Full Name</label>
              <input
                type="text"
                name="owner_name"
                value={formData.owner_name}
                onChange={handleChange}
                required
                className="w-full border border-gray-300 rounded px-3 py-2"
              />
            </div>
            <div>
              <label className="block text-sm font-medium mb-1">Owner's Phone</label>
              <input
                type="tel"
                name="owner_phone"
                value={formData.owner_phone}
                onChange={handleChange}
                required
                className="w-full border border-gray-300 rounded px-3 py-2"
              />
            </div>
            <div className="md:col-span-2">
              <label className="block text-sm font-medium mb-1">Owner's Address</label>
              <textarea
                name="owner_address"
                rows="2"
                value={formData.owner_address}
                onChange={handleChange}
                required
                className="w-full border border-gray-300 rounded px-3 py-2"
              ></textarea>
            </div>
          </div>
        </div>

        {/* Buttons */}
        <div className="flex items-center justify-start space-x-4">
          <button
            type="submit"
            className="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition"
          >
            Update Business
          </button>
          <button
            type="button"
            className="border border-gray-400 px-5 py-2 rounded hover:bg-gray-100"
            onClick={() => navigate('/business-registry')}
          >
            Cancel
          </button>
        </div>
      </form>
    </div>
  );
};

export default EditBusinessRegistry;