<style>
  :root {
    --bg-dark: #1f2937;
    --head: #111827;
    --text-light: #f5f5f5;
    --muted: rgba(245, 245, 245, 0.7);
    --accent: #3b82f6;
    --border: rgba(255, 255, 255, 0.1);
  }

  .form-card {
    background: var(--bg-dark);
    color: var(--text-light);
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(15, 23, 42, 0.35);
    max-width: 760px;
    margin: 40px auto;
    font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
  }

  .form-title {
    font-size: 1.4rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    color: var(--text-light);
    border-bottom: 2px solid rgba(255, 255, 255, 0.05);
    padding-bottom: 0.5rem;
  }

  .form-group {
    margin-bottom: 1.4rem;
  }

  label {
    display: block;
    font-size: 0.9rem;
    font-weight: 500;
    color: var(--muted);
    margin-bottom: 0.4rem;
  }

  input[type="text"],
  textarea {
    width: 100%;
    background: var(--head);
    border: 1px solid var(--border);
    border-radius: 8px;
    color: var(--text-light);
    font-size: 0.95rem;
    padding: 10px 12px;
    transition: border-color 0.15s ease, box-shadow 0.15s ease;
  }

  textarea {
    min-height: 100px;
    resize: vertical;
  }

  input[type="text"]:focus,
  textarea:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.25);
    outline: none;
  }

  .hero-placeholder {
    background: var(--head);
    border: 1px dashed var(--border);
    border-radius: 10px;
    height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--muted);
    font-size: 0.95rem;
  }

  .gallery-placeholder {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
  }

  .gallery-placeholder div {
    background: var(--head);
    border: 1px dashed var(--border);
    border-radius: 8px;
    width: 90px;
    height: 90px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--muted);
    font-size: 0.8rem;
  }

  .wysiwyg-placeholder {
    background: var(--head);
    border: 1px solid var(--border);
    border-radius: 8px;
    color: var(--muted);
    padding: 12px;
    min-height: 160px;
  }

  /* Custom select styling */
  .select-wrapper {
    position: relative;
    width: 220px;
  }

  .custom-select {
    appearance: none;
    width: 100%;
    background: var(--head);
    border: 1px solid var(--border);
    border-radius: 8px;
    color: var(--text-light);
    font-size: 0.95rem;
    padding: 10px 36px 10px 12px;
    cursor: pointer;
    transition: border-color 0.15s ease, box-shadow 0.15s ease;
  }

  .custom-select:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.25);
    outline: none;
  }

  .select-wrapper::after {
    content: "▾";
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--muted);
    pointer-events: none;
    font-size: 0.9rem;
  }

  .btn-submit {
    background: var(--accent);
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    font-size: 0.95rem;
    transition: background 0.2s ease, transform 0.1s ease;
  }

  .btn-submit:hover {
    background: #2563eb;
    transform: translateY(-1px);
  }
</style>

<div class="form-card">
  <div class="form-title">Add New Project</div>

  <form>
    <div class="form-group">
      <label>Project Title</label>
      <input type="text" placeholder="Enter project title">
    </div>

    <div class="form-group">
      <label>Hero Image</label>
      <div class="hero-placeholder">Hero Image Preview</div>
    </div>

    <div class="form-group">
      <label>Gallery Images</label>
      <div class="gallery-placeholder">
        <div>Image 1</div>
        <div>Image 2</div>
        <div>Image 3</div>
      </div>
    </div>

    <div class="form-group">
      <label>Short Description</label>
      <textarea placeholder="Write a short summary..."></textarea>
    </div>

    <div class="form-group">
      <label>Detailed Description</label>
      <div class="wysiwyg-placeholder">[WYSIWYG Editor goes here]</div>
    </div>

    <div class="form-group">
      <label>Status</label>
      <div class="select-wrapper">
        <select class="custom-select">
          <option>Pending</option>
          <option>Published</option>
        </select>
      </div>
    </div>

    <button type="submit" class="btn-submit">Save Project</button>
  </form>
</div>
