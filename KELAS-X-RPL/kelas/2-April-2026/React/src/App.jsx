import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
import { AuthProvider, useAuth } from './contexts/AuthContext';
import { Toaster } from 'react-hot-toast';

import MainLayout from './layouts/MainLayout';
import Login from './pages/Login';
import Register from './pages/Register';
import Dashboard from './pages/Dashboard';
import Skills from './pages/Skills';
import Portfolios from './pages/Portfolios';
import Home from './pages/Home';

const ProtectedRoute = ({ children }) => {
  const { user, token, loading } = useAuth();
  
  if (loading) return <div className="text-center" style={{ marginTop: '5rem' }}>Loading...</div>;
  if (!token) return <Navigate to="/login" replace />;
  
  return children;
};

const PublicRoute = ({ children }) => {
  const { token, loading } = useAuth();
  
  if (loading) return <div className="text-center" style={{ marginTop: '5rem' }}>Loading...</div>;
  if (token) return <Navigate to="/dashboard" replace />;
  
  return children;
};

function AppRoutes() {
  return (
    <Routes>
      {/* Public Home Page - outside MainLayout to take full screen */}
      <Route path="/" element={<Home />} />
      
      <Route path="/" element={<MainLayout />}>
        {/* Public Routes */}
        <Route 
          path="login" 
          element={
            <PublicRoute>
              <Login />
            </PublicRoute>
          } 
        />
        <Route 
          path="register" 
          element={
            <PublicRoute>
              <Register />
            </PublicRoute>
          } 
        />
        
        {/* Protected Routes */}
        <Route 
          path="dashboard" 
          element={
            <ProtectedRoute>
              <Dashboard />
            </ProtectedRoute>
          } 
        />
        <Route 
          path="skills" 
          element={
            <ProtectedRoute>
              <Skills />
            </ProtectedRoute>
          } 
        />
        <Route 
          path="portfolios" 
          element={
            <ProtectedRoute>
              <Portfolios />
            </ProtectedRoute>
          } 
        />
      </Route>
    </Routes>
  );
}

function App() {
  return (
    <AuthProvider>
      <Router>
        <AppRoutes />
        <Toaster position="top-right" />
      </Router>
    </AuthProvider>
  );
}

export default App;
