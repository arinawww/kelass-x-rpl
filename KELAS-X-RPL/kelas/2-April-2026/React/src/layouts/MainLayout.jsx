import { Outlet, Link, useNavigate } from 'react-router-dom';
import { useAuth } from '../contexts/AuthContext';
import { LogOut, Home, Briefcase, Award, User } from 'lucide-react';

export default function MainLayout() {
  const { user, logout } = useAuth();
  const navigate = useNavigate();

  const handleLogout = async () => {
    await logout();
    navigate('/login');
  };

  return (
    <div className="main-layout transition-fade">
      {/* Sidebar */}
      <aside className="sidebar">
        <div className="sidebar-title">
          <h1 className="sidebar-brand">
            Arina Portfolios
          </h1>
        </div>
        
        <nav className="nav-links">
          {user ? (
            <>
              <Link to="/dashboard" className="nav-link">
                <Home size={20} /> Dashboard
              </Link>
              <Link to="/skills" className="nav-link">
                <Award size={20} /> Skills
              </Link>
              <Link to="/portfolios" className="nav-link">
                <Briefcase size={20} /> Portfolios
              </Link>
            </>
          ) : (
            <>
              <Link to="/login" className="nav-link">
                <User size={20} /> Login
              </Link>
              <Link to="/register" className="nav-link">
                <User size={20} /> Register
              </Link>
            </>
          )}
        </nav>

        {user && (
          <div className="sidebar-footer">
            <button 
              onClick={handleLogout}
              className="btn btn-danger-outline"
              style={{ width: '100%' }}
            >
              <LogOut size={18} /> Logout Account
            </button>
          </div>
        )}
      </aside>

      {/* Content Area */}
      <main style={{ flex: 1, padding: '2.5rem', overflowY: 'auto', position: 'relative' }}>
        <div style={{ maxWidth: '1024px', margin: '0 auto', position: 'relative', zIndex: 10 }}>
          <Outlet />
        </div>
      </main>
    </div>
  );
}
