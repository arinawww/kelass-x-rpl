import { useState } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import { useAuth } from '../contexts/AuthContext';
import toast from 'react-hot-toast';

export default function Register() {
  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [loading, setLoading] = useState(false);
  const { register } = useAuth();
  const navigate = useNavigate();

  const handleSubmit = async (e) => {
    e.preventDefault();
    setLoading(true);
    try {
      const success = await register(name, email, password);
      if (success) {
        toast.success('Registration successful!');
        navigate('/dashboard');
      }
    } catch (error) {
      toast.error('Registration failed');
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="auth-container">
      <div className="auth-card">
        <h2 className="text-center" style={{ fontSize: '1.5rem', fontWeight: 800, marginBottom: '0.5rem' }}>Create Account</h2>
        <p className="text-center" style={{ color: 'var(--slate-500)', marginBottom: '2rem' }}>Join us and start showcasing your work.</p>
        
        <form onSubmit={handleSubmit}>
          <div className="input-group">
            <label className="label">Full Name</label>
            <input 
              type="text" 
              required
              className="input-field"
              value={name}
              onChange={(e) => setName(e.target.value)}
              placeholder="e.g. Arina"
            />
          </div>
          <div className="input-group">
            <label className="label">Email Address</label>
            <input 
              type="email" 
              required
              className="input-field"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              placeholder="name@example.com"
            />
          </div>
          <div className="input-group">
            <label className="label">Password</label>
            <input 
              type="password" 
              required
              className="input-field"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              placeholder="••••••••"
            />
          </div>
          
          <button 
            type="submit" 
            disabled={loading}
            className="btn btn-primary w-full"
            style={{ padding: '1rem', marginTop: '1rem' }}
          >
            {loading ? 'Creating account...' : 'Create Account'}
          </button>
        </form>
        
        <p className="text-center mt-2" style={{ marginTop: '1.5rem', fontSize: '0.875rem' }}>
          Already have an account? <Link to="/login" style={{ color: 'var(--primary)', fontWeight: 600, textDecoration: 'none' }}>Login here</Link>
        </p>
      </div>
    </div>
  );
}
