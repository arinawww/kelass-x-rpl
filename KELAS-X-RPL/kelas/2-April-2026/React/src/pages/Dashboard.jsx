import { useState, useEffect } from 'react';
import api from '../services/api';
import toast from 'react-hot-toast';

export default function Dashboard() {
  const [profile, setProfile] = useState({ bio: '', cita_cita: '' });
  const [loading, setLoading] = useState(true);
  const [saving, setSaving] = useState(false);

  useEffect(() => {
    fetchProfile();
  }, []);

  const fetchProfile = async () => {
    try {
      const response = await api.get('/profile');
      if (response.data.success && response.data.data) {
        setProfile(response.data.data);
      }
    } catch (error) {
      toast.error('Failed to load profile');
    } finally {
      setLoading(false);
    }
  };

  const handleSave = async (e) => {
    e.preventDefault();
    setSaving(true);
    
    try {
      const response = await api.post('/profile', {
        bio: profile.bio,
        cita_cita: profile.cita_cita
      });

      if (response.data.success) {
        toast.success('Profile updated successfully!');
        setProfile(response.data.data);
      }
    } catch (error) {
      toast.error('Failed to save profile');
    } finally {
      setSaving(false);
    }
  };

  if (loading) return <div className="text-center" style={{ padding: '5rem 0', color: 'var(--slate-500)' }}>Loading your dashboard...</div>;

  return (
    <div className="dashboard-container">
      <div className="dashboard-header">
        <h2 className="dashboard-title">Profile Settings</h2>
        <p className="dashboard-subtitle">Manage your public portfolio information and identity.</p>
      </div>

      <div className="form-card">
        <div className="form-accent" />
        <div className="form-body">
          <form onSubmit={handleSave} className="form-stack">
            <div className="form-grid-item">
              <div className="form-sidebar">
                <label className="label">Cita-Cita</label>
                <p style={{ fontSize: '0.75rem', color: 'var(--slate-400)' }}>Your professional goal or tagline.</p>
              </div>
              <div className="form-main">
                <input 
                  type="text" 
                  className="input-field"
                  value={profile.cita_cita || ''}
                  onChange={(e) => setProfile({...profile, cita_cita: e.target.value})}
                  placeholder="e.g. Senior Frontend Developer"
                />
              </div>
            </div>

            <div className="divider" style={{ borderTop: '1px solid var(--slate-50)', margin: '2rem 0' }} />

            <div className="form-grid-item">
              <div className="form-sidebar">
                <label className="label">Biography</label>
                <p style={{ fontSize: '0.75rem', color: 'var(--slate-400)' }}>Brief introduction about yourself.</p>
              </div>
              <div className="form-main">
                <textarea 
                  className="input-field"
                  style={{ minHeight: '160px' }}
                  value={profile.bio || ''}
                  onChange={(e) => setProfile({...profile, bio: e.target.value})}
                  placeholder="I am a passionate developer who loves..."
                ></textarea>
              </div>
            </div>
            
            <div className="divider" style={{ borderTop: '1px solid var(--slate-50)', margin: '2rem 0' }} />

            <div style={{ display: 'flex', justifyContent: 'flex-end' }}>
              <button 
                type="submit" 
                disabled={saving}
                className="btn btn-primary"
                style={{ minWidth: '200px' }}
              >
                {saving ? 'Saving...' : 'Update Profile'}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  );
}
