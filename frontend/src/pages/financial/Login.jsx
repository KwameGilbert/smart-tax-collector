import React, { useState } from "react";

const FinanceLogin = () => {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [loading, setLoading] = useState(false);
  const [alert, setAlert] = useState(null);

  const handleSubmit = async (e) => {
    e.preventDefault();
    setLoading(true);
    setAlert(null);

    // Simulated API response (replace with real fetch call)
    setTimeout(() => {
      if (email === "finance@example.com" && password === "password123") {
        setAlert({
          type: "success",
          message: "Login successful. Redirecting...",
        });
        setTimeout(() => {
          window.location.href = "/finance";
        }, 1000);
      } else {
        setAlert({ type: "error", message: "Invalid email or password." });
        setLoading(false);
      }
    }, 1000);
  };

  const renderAlert = () => {
    if (!alert) return null;
    const alertClass =
      alert.type === "error"
        ? "bg-red-50 text-red-800"
        : "bg-green-50 text-green-800";
    const iconClass =
      alert.type === "error"
        ? "ri-alert-line text-red-400"
        : "ri-check-line text-green-400";

    return (
      <div className={`rounded-md ${alertClass} p-4 alert-fade-in`}>
        <div className="flex">
          <div className="flex-shrink-0">
            <i className={`${iconClass} text-lg`}></i>
          </div>
          <div className="ml-3">
            <p className="text-sm font-medium">{alert.message}</p>
          </div>
        </div>
      </div>
    );
  };

  return (
    <div className="bg-gray-50 min-h-screen flex flex-col">
      <div className="flex flex-1 min-h-full">
        {/* Login Form */}
        <div className="flex flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24 w-full lg:w-1/2">
          <div className="mx-auto w-full max-w-sm lg:w-96">
            <div className="mb-10">
              <img
                src="/logo.png"
                alt="Sefwi Tax Collection"
                className="h-12 w-auto"
              />
              <h2 className="mt-8 text-2xl font-bold text-gray-900">
                Finance Department Portal
              </h2>
              <p className="mt-2 text-sm text-gray-500">
                Access your financial management dashboard
              </p>
            </div>

            {renderAlert()}

            <form className="space-y-6" onSubmit={handleSubmit}>
              <div>
                <label className="block text-sm font-medium text-gray-900">
                  Email address
                </label>
                <input
                  type="email"
                  value={email}
                  onChange={(e) => setEmail(e.target.value)}
                  required
                  className="mt-2 block w-full rounded-md border-0 py-1.5 px-3 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-blue-600 sm:text-sm"
                />
              </div>

              <div>
                <div className="flex items-center justify-between">
                  <label className="block text-sm font-medium text-gray-900">
                    Password
                  </label>
                  {/* <a
                    href="#"
                    className="text-sm font-semibold text-blue-600 hover:text-blue-500"
                  >
                    Forgot password?
                  </a> */}
                </div>
                <input
                  type="password"
                  value={password}
                  onChange={(e) => setPassword(e.target.value)}
                  required
                  className="mt-2 block w-full rounded-md border-0 py-1.5 px-3 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-blue-600 sm:text-sm"
                />
              </div>

              <button
                type="submit"
                disabled={loading}
                className="flex w-full justify-center items-center rounded-md bg-blue-600 px-3 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-blue-600"
              >
                {loading ? (
                  <>
                    <span>Signing in...</span>
                    <span className="ml-2 w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></span>
                  </>
                ) : (
                  "Sign in"
                )}
              </button>
            </form>

            <footer className="bg-white py-4 border-t border-gray-200 mt-8">
              <p className="text-center text-xs text-gray-500">
                &copy; 2025 Sefwi Municipality Tax Collection System. All rights
                reserved.
              </p>
              <div className="text-center py-2 text-xs text-gray-500">
                <span>Developed by </span>
                <a
                  href="tel:+233541436414"
                  className="text-blue-600 font-medium hover:text-blue-800"
                >
                  Gilbert Elikplim Kukah
                </a>
                <span className="px-1">|</span>
                <a href="tel:+233541436414" className="hover:text-blue-600">
                  0541436414
                </a>
              </div>
            </footer>
          </div>
        </div>

        {/* Right Side */}
        <div className="hidden lg:block relative w-0 flex-1 bg-cover bg-center login-background">
          <div className="absolute inset-0 bg-gradient-to-r from-blue-800 to-blue-900 opacity-60"></div>
          <div className="absolute inset-0 flex flex-col justify-center items-center p-8 text-white">
            <div className="bg-black/65 p-8 rounded-lg max-w-md text-center">
              <h2 className="text-3xl font-bold mb-4">
                Finance Management Portal
              </h2>
              <p className="mb-6">
                Access financial reports, manage tax configurations, and monitor
                revenue collection for Sefwi Municipality.
              </p>
              <div className="flex justify-center space-x-6">
                <div className="text-center">
                  <div className="text-3xl font-bold">GHS 2.4M</div>
                  <div className="text-sm opacity-80">Revenue Target</div>
                </div>
                <div className="h-12 border-r border-white opacity-30"></div>
                <div className="text-center">
                  <div className="text-3xl font-bold">1,450+</div>
                  <div className="text-sm opacity-80">Taxpayers</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default FinanceLogin;
