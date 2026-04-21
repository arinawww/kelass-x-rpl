import { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import api from '../services/api';
import { ExternalLink, User, ArrowRight, Globe, Mail } from 'lucide-react';

export default function Home() {
  const [data, setData] = useState({ profile: null, skills: [], portfolios: [] });
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchPublicData = async () => {
      try {
        const [profileRes, skillsRes, portfoliosRes] = await Promise.all([
          api.get('/profile/public').catch(() => ({ data: { success: false } })),
          api.get('/skills'),
          api.get('/portfolios')
        ]);
        
        setData({
          profile: profileRes.data.success ? profileRes.data.data : null,
          skills: skillsRes.data.success ? skillsRes.data.data : [],
          portfolios: portfoliosRes.data.success ? portfoliosRes.data.data : [],
        });
      } catch (error) {
        console.error("Error fetching public portfolio", error);
      } finally {
        setLoading(false);
      }
    };

    fetchPublicData();
  }, []);

  if (loading) {
    return (
      <div className="flex justify-center items-center" style={{ minHeight: '100vh' }}>
        <div className="text-center">
          <p style={{ color: 'var(--primary)', fontWeight: 600 }}>Loading...</p>
        </div>
      </div>
    );
  }

  const { profile, skills, portfolios } = data;

  return (
    <div className="home-page">
      {/* Header */}
      <header className="header">
        <div className="container header-content">
          <h1 className="logo">
            {profile?.name || 'Arina'}
          </h1>
          <Link to="/login" className="nav-admin-link">
            Admin <ArrowRight size={14} />
          </Link>
        </div>
      </header>

      <main className="container">
        
        {/* Hero Section */}
        <section className="hero">
          <h2>
            I'm <span className="gradient-text">{profile?.name || 'Arina'}</span>
          </h2>
          
          <p>
            {profile?.cita_cita || 'Building clean, functional, and efficient digital experiences.'}
          </p>
          
          {profile?.bio && (
            <p className="bio-text">
              {profile.bio}
            </p>
          )}

          <div className="hero-actions">
            <a href="#projects" className="link-underlined">Projects</a>
            <a href="#contact" className="link-underlined">Contact</a>
          </div>
        </section>

        {/* Skills Section */}
        {skills.length > 0 && (
          <section className="section">
            <div className="flex-md-row">
              <div className="section-intro">
                <span className="badge">Expertise</span>
                <h4 className="section-title">Technical <br />Skills</h4>
              </div>
              
              <div className="skills-list">
                {skills.map((skill) => (
                  <div key={skill.id} className="skill-item">
                    <div className="skill-item-header">
                      <span className="font-bold">{skill.name}</span>
                      <span className="skill-level-text">{skill.level}%</span>
                    </div>
                    <div className="progress-bar">
                      <div 
                        className="progress-fill"
                        style={{ width: `${skill.level}%` }}
                      />
                    </div>
                  </div>
                ))}
              </div>
            </div>
          </section>
        )}

        {/* Portfolio Section */}
        {portfolios.length > 0 && (
          <section id="projects" className="section no-border">
            <div className="title-section">
              <span className="badge">Works</span>
              <h4 className="section-title">Selected Projects</h4>
            </div>

            <div className="grid grid-cols-2">
              {portfolios.map((project) => (
                <div key={project.id} className="portfolio-card">
                  <div className="portfolio-img-placeholder">
                    <Globe size={48} />
                  </div>
                  <h4 className="portfolio-title">{project.title}</h4>
                  <p className="portfolio-desc">{project.description}</p>
                  
                  {project.link && (
                    <a 
                      href={project.link}
                      target="_blank"
                      rel="noopener noreferrer"
                      className="btn-link"
                    >
                      View Live Project <ExternalLink size={14} />
                    </a>
                  )}
                </div>
              ))}
            </div>
          </section>
        )}

      </main>

      {/* Footer */}
      <footer id="contact" className="footer">
        <div className="container">
          <div className="footer-content">
            <div className="footer-info">
              <h2 className="footer-logo">{profile?.name || 'Arina'}</h2>
              <p className="text-slate-500">
                Design-driven developer focused on building high-quality digital products. Always open to new opportunities.
              </p>
            </div>
            
            <div className="footer-social">
              <span className="badge">Connect</span>
              <div className="flex gap-4" style={{ marginTop: '1rem' }}>
                <a href="mailto:hello@example.com" className="social-icon">
                  <Mail size={18} />
                </a>
                <a href="#" className="social-icon">
                  <Globe size={18} />
                </a>
              </div>
            </div>
          </div>
          <div className="footer-bottom">
            © {new Date().getFullYear()} {profile?.name || 'User'}. Built with React & Laravel.
          </div>
        </div>
      </footer>
    </div>
  );
}
