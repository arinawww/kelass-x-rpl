import { useState, useEffect } from 'react';
import api from '../services/api';
import toast from 'react-hot-toast';
import { Trash2 } from 'lucide-react';

export default function Skills() {
  const [skills, setSkills] = useState([]);
  const [name, setName] = useState('');
  const [level, setLevel] = useState(50);
  const [loading, setLoading] = useState(true);
  const [adding, setAdding] = useState(false);

  useEffect(() => {
    fetchSkills();
  }, []);

  const fetchSkills = async () => {
    try {
      const response = await api.get('/skills');
      if (response.data.success) {
        setSkills(response.data.data);
      }
    } catch (error) {
      toast.error('Failed to load skills');
    } finally {
      setLoading(false);
    }
  };

  const handleAddSkill = async (e) => {
    e.preventDefault();
    if (!name) return;
    
    setAdding(true);
    try {
      const response = await api.post('/skills', { name, level });
      if (response.data.success) {
        toast.success('Skill added!');
        setSkills([...skills, response.data.data]);
        setName('');
        setLevel(50);
      }
    } catch (error) {
      toast.error('Failed to add skill');
    } finally {
      setAdding(false);
    }
  };

  const handleDelete = async (id) => {
    if (!confirm('Are you sure you want to delete this skill?')) return;
    
    try {
      await api.delete(`/skills/${id}`);
      toast.success('Skill deleted');
      setSkills(skills.filter(s => s.id !== id));
    } catch (error) {
      toast.error('Failed to delete skill');
    }
  };

  if (loading) return <div className="text-center" style={{ padding: '5rem 0', color: 'var(--slate-500)' }}>Loading skills...</div>;

  return (
    <div className="max-w-4xl" style={{ margin: '0 auto' }}>
      <div className="dashboard-header">
        <h2 className="dashboard-title">Technical Skills</h2>
        <p className="dashboard-subtitle">Display your expertise level to showcase your professional strength.</p>
      </div>

      {/* Add New Skill Form */}
      <div className="form-card mb-8" style={{ marginBottom: '3rem' }}>
        <div className="form-accent" />
        <div className="p-6">
          <form onSubmit={handleAddSkill} style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(200px, 1fr))', gap: '1.5rem', alignItems: 'flex-end' }}>
            <div style={{ flex: 1 }}>
              <label className="label">Skill Name</label>
              <input 
                type="text" 
                required
                className="input-field"
                value={name}
                onChange={(e) => setName(e.target.value)}
                placeholder="e.g. React.js"
              />
            </div>
            <div style={{ width: '120px' }}>
              <label className="label">Level (%)</label>
              <input 
                type="number" 
                min="1" max="100"
                className="input-field"
                value={level}
                onChange={(e) => setLevel(e.target.value)}
              />
            </div>
            <div>
              <button 
                type="submit" 
                disabled={adding}
                className="btn btn-primary"
                style={{ width: '100%', height: '58px' }}
              >
                {adding ? 'Adding...' : 'Add Skill'}
              </button>
            </div>
          </form>
        </div>
      </div>

      {/* Skills List */}
      <div className="grid grid-cols-2">
        {skills.map(skill => (
          <div key={skill.id} className="skill-card">
            <div className="skill-header">
              <h3 className="font-bold">{skill.name}</h3>
              <button 
                onClick={() => handleDelete(skill.id)}
                className="btn-icon"
                style={{ background: 'transparent', color: 'var(--slate-300)', border: 'none', cursor: 'pointer' }}
              >
                <Trash2 size={18} />
              </button>
            </div>
            <div className="skill-progress-container">
              <div style={{ display: 'flex', justifyContent: 'space-between', marginBottom: '0.5rem' }}>
                <span className="badge">Proficiency</span>
                <span style={{ fontSize: '0.75rem', fontWeight: 900, color: 'var(--primary)' }}>{skill.level}%</span>
              </div>
              <div className="progress-bar">
                <div 
                  className="progress-fill" 
                  style={{ width: `${skill.level}%`, background: 'var(--primary)' }} 
                />
              </div>
            </div>
          </div>
        ))}
        
        {skills.length === 0 && (
          <div className="col-span-full" style={{ padding: '3rem', textAlign: 'center', background: 'var(--slate-50)', borderRadius: 'var(--radius-2xl)', border: '2px dashed var(--slate-200)' }}>
            <p style={{ color: 'var(--slate-400)', fontStyle: 'italic' }}>No skills added yet. Define your expertise above!</p>
          </div>
        )}
      </div>
    </div>
  );
}
