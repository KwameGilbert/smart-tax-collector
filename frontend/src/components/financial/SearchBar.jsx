import React from 'react';

const SearchBar = ({ value, onChange }) => (
  <div className="mb-4">
    <input
      type="text"
      value={value}
      onChange={onChange}
      placeholder="Search by business name or tax type"
      className="w-full sm:w-64 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition"
    />
  </div>
);

export default SearchBar;
