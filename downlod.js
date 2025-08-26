
document.addEventListener('DOMContentLoaded', () => {
  const btn = document.getElementById('downloadCvBtn');
  if (!btn) {
    console.error('No element found with id="downloadCvBtn". Check the id or move script below the button.');
    return;
  }

  // safe helpers
  const sanitizeFilename = (name) => {
    if (!name) return 'CV.pdf';
    // remove querystring/hash and path
    name = name.split(/[?#]/)[0].split(/[\\/]/).pop();
    try { name = decodeURIComponent(name); } catch (e) { /* ignore decode errors */ }
    // allow letters, numbers, dot, dash, underscore; replace others with _
    name = name.replace(/[^a-zA-Z0-9.\-_]/g, '_');
    if (!name.includes('.')) name += '.pdf';
    return name || 'CV.pdf';
  };

  const filenameFromDisposition = (disp) => {
    if (!disp) return null;
    const utf8Match = /filename\*\s*=\s*UTF-8''([^;]+)/i.exec(disp);
    if (utf8Match) {
      try { return decodeURIComponent(utf8Match[1]); } catch (e) { return utf8Match[1]; }
    }
    const qMatch = /filename\s*=\s*"([^"]+)"/i.exec(disp);
    if (qMatch) return qMatch[1];
    const rawMatch = /filename\s*=\s*([^;]+)/i.exec(disp);
    if (rawMatch) return rawMatch[1].trim();
    return null;
  };

  btn.addEventListener('click', async () => {
    const fileUrl = btn.getAttribute('data-file') || btn.dataset.file || '';
    if (!fileUrl) {
      console.error('data-file attribute missing on button.');
      alert('File not configured. Contact developer.');
      return;
    }

    try {
      // Try to fetch (works even when server doesn't set Content-Disposition)
      const res = await fetch(fileUrl);
      if (!res.ok) throw new Error('HTTP ' + res.status + ' — ' + res.statusText);

      // Prefer filename sent by server, fall back to URL basename
      const disp = res.headers.get('content-disposition') || res.headers.get('Content-Disposition');
      const serverName = filenameFromDisposition(disp);
      const suggestedName = sanitizeFilename(serverName || new URL(fileUrl, location.href).pathname.split('/').pop());

      const blob = await res.blob();
      const a = document.createElement('a');
      a.style.display = 'none';
      a.href = URL.createObjectURL(blob);
      a.download = suggestedName;
      document.body.appendChild(a);
      a.click();
      // remove element, revoke object URL after slight delay to ensure download started
      setTimeout(() => {
        URL.revokeObjectURL(a.href);
        a.remove();
      }, 1000);
    } catch (err) {
      // Helpful debug info
      console.error('Download failed:', err);
      // Fallback: try direct link click (works if same-origin or browser allows)
      try {
        const suggestedName = sanitizeFilename(fileUrl.split('/').pop());
        const a = document.createElement('a');
        a.style.display = 'none';
        a.href = fileUrl;
        a.target = '_blank';
        // Note: download attribute may be ignored for cross-origin resources
        a.download = suggestedName;
        document.body.appendChild(a);
        a.click();
        setTimeout(() => a.remove(), 500);
      } catch (err2) {
        console.error('Fallback open also failed:', err2);
        alert('Download failed. Check console (F12) for details.');
      }
    }
  });
});