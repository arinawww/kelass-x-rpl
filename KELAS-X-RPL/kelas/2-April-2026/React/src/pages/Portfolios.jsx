import { useState, useEffect } from 'react';
import api from '../services/api';
import toast from 'react-hot-toast';
import { Trash2, ExternalLink } from 'lucide-react';

export default function Portfolios() {
  const [portfolios, setPortfolios] = useState([]);
  const [title, setTitle] = useState('');
  const [description, setDescription] = useState('');
  const [link, setLink] = useState('');
  
  const [loading, setLoading] = useState(true);
  const [adding, setAdding] = useState(false);

  useEffect(() => {
    fetchPortfolios();
  }, []);

  const fetchPortfolios = async () => {
    try {
      const response = await api.get('/portfolios');
      if (response.data.success) {
        setPortfolios(response.data.data);
      }
    } catch (error) {
      toast.error('Failed to load portfolios');
    } finally {
      setLoading(false);
    }
  };

  const handleAddPortfolio = async (e) => {
    e.preventDefault();
    if (!title || !description) return;
    
    setAdding(true);
    try {
      const response = await api.post('/portfolios', { title, description, link });
      if (response.data.success) {
        toast.success('Portfolio added!');
        setPortfolios([...portfolios, response.data.data]);
        setTitle('');
        setDescription('');
        setLink('');
      }
    } catch (error) {
      toast.error('Failed to add portfolio');
    } finally {
      setAdding(false);
    }
  };

  const handleDelete = async (id) => {
    if (!confirm('Are you sure you want to delete this portfolio?')) return;
    
    try {
      await api.delete(`/portfolios/${id}`);
      toast.success('Portfolio deleted');
      setPortfolios(portfolios.filter(p => p.id !== id));
    } catch (error) {
      toast.error('Failed to delete portfolio');
    }
  };

  if (loading) return <div className="text-center" style={{ padding: '5rem 0', color: 'var(--slate-500)' }}>Loading portfolios...</div>;

  return (
    <div className="max-w-4xl" style={{ margin: '0 auto' }}>
      <div className="dashboard-header">
        <h2 className="dashboard-title">Project Portfolios</h2>
        <p className="dashboard-subtitle">Manage and showcase your best work to visitors.</p>
      </div>
      
      {/* Add New Portfolio Form */}
      <div className="form-card mb-12" style={{ marginBottom: '3rem' }}>
        <div className="form-accent" />
        <div className="p-8">
          <form onSubmit={handleAddPortfolio} style={{ display: 'grid', gap: '1.5rem' }}>
            <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(200px, 1fr))', gap: '1.5rem' }}>
              <div>
                <label className="label">Project Title</label>
                <input 
                  type="text" 
                  required
                  className="input-field"
                  value={title}
                  onChange={(e) => setTitle(e.target.value)}
                  placeholder="e.g. E-Commerce Platform"
                />
              </div>
              <div>
                <label className="label">Project Link (Optional)</label>
                <input 
                  type="text" 
                  className="input-field"
                  value={link}
                  onChange={(e) => setLink(e.target.value)}
                  placeholder="https://yourproject.com"
                />
              </div>
            </div>
            <div>
              <label className="label">Description</label>
              <textarea 
                required
                className="input-field"
                style={{ minHeight: '100px' }}
                value={description}
                onChange={(e) => setDescription(e.target.value)}
                placeholder="Briefly describe what this project is about..."
              ></textarea>
            </div>
            <div style={{ display: 'flex', justifyContent: 'flex-end' }}>
              <button 
                type="submit" 
                disabled={adding}
                className="btn btn-primary"
                style={{ minWidth: '220px' }}
              >
                {adding ? 'Adding...' : 'Add Project Portfolio'}
              </button>
            </div>
          </form>
        </div>
      </div>

      {/* Portfolios List */}
      <div style={{ display: 'grid', gap: '2rem' }}>
        {portfolios.map(portfolio => (
          <div key={portfolio.id} className="card" style={{ padding: '2rem', display: 'flex', flexDirection: 'column' }}>
            <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'flex-start', marginBottom: '1rem' }}>
              <h3 style={{ fontSize: '1.25rem', fontWeight: 800, color: 'var(--slate-800)' }}>{portfolio.title}</h3>
              <button 
                onClick={() => handleDelete(portfolio.id)}
                style={{ background: 'transparent', border: 'none', color: 'var(--slate-300)', cursor: 'pointer' }}
              >
                <Trash2 size={18} />
              </button>
            </div>
            
            <p style={{ color: 'var(--slate-500)', marginBottom: '1.5rem', lineHeight: 1.6 }}>{portfolio.description}</p>
            
            {portfolio.link && (
              <a 
                href={portfolio.link}
                target="_blank"
                rel="noopener noreferrer"
                className="btn-link"
              >
                View Live Project <ExternalLink size={14} />
              </a>
            )}
          </div>
        ))}
        
        {portfolios.length === 0 && (
          <div style={{ padding: '4rem', textAlign: 'center', background: 'var(--slate-50)', borderRadius: 'var(--radius-2xl)', border: '2px dashed var(--slate-200)' }}>
            <p style={{ color: 'var(--slate-400)', fontStyle: 'italic' }}>No projects added yet. Start your showcase above!</p>
          </div>
        )}
      </div>
    </div>
  );
}
