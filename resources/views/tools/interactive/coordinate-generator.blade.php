<div class="row g-4 coords-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Quantity</label>
                        <input type="number" id="coords-count" class="form-control form-control-lg" value="5" min="1" max="100">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Format</label>
                        <select id="coords-format" class="form-select form-select-lg">
                            <option value="dd" selected>Decimal Degrees (DD)</option>
                            <option value="dms">Degrees, Minutes, Seconds (DMS)</option>
                        </select>
                    </div>
                </div>

                <button class="btn d-block mx-auto btn-primary fw-bold fs-5 py-3 px-5 fw-bold rounded-pill shadow-sm"" id="coords-generate" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-map-marker-alt me-2"></i>Generate Coordinates
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none" id="coords-output-card" style="--tool-hue:210;--tool-color:#2563eb;--tool-bg:rgba(59,130,246,.04); border-color:#bfdbfe;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-map-signs me-2 text-primary"></i>Generated Locations</h5>
                <button class="btn btn-sm btn-outline-dark" id="copy-coords" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-1"></i>Copy All</button>
            </div>
            
            <div class="table-responsive bg-white rounded-3 border">
                <table class="table table-hover mb-0 align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th class="text-uppercase small fw-bold text-muted py-3">Latitude</th>
                            <th class="text-uppercase small fw-bold text-muted py-3">Longitude</th>
                            <th class="text-uppercase small fw-bold text-muted py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody id="coords-table-body">
                        <!-- Rows injected here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.coords-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.coords-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.coords-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.coords-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.coords-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.coords-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:.4rem;}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    function toDMS(coordinate, isLatitude) {
        const absolute = Math.abs(coordinate);
        const degrees = Math.floor(absolute);
        const minutesNotTruncated = (absolute - degrees) * 60;
        const minutes = Math.floor(minutesNotTruncated);
        const seconds = ((minutesNotTruncated - minutes) * 60).toFixed(2);
        
        let direction = '';
        if (isLatitude) {
            direction = coordinate >= 0 ? 'N' : 'S';
        } else {
            direction = coordinate >= 0 ? 'E' : 'W';
        }

        return `${degrees}° ${minutes}' ${seconds}" ${direction}`;
    }

    $('coords-generate').addEventListener('click', function() {
        const count = parseInt($('coords-count').value) || 1;
        const format = $('coords-format').value;
        
        const tbody = $('coords-table-body');
        tbody.innerHTML = '';
        let rawData = "Latitude\tLongitude\n";

        for (let i = 0; i < count; i++) {
            // Lat: -90 to 90
            const lat = (Math.random() * 180 - 90).toFixed(6);
            // Lon: -180 to 180
            const lon = (Math.random() * 360 - 180).toFixed(6);

            let displayLat, displayLon;
            
            if (format === 'dms') {
                displayLat = toDMS(lat, true);
                displayLon = toDMS(lon, false);
            } else {
                displayLat = lat;
                displayLon = lon;
            }

            rawData += `${displayLat}\t${displayLon}\n`;

            const mapsLink = `https://www.google.com/maps/place/${lat},${lon}`;

            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td class="fw-bold font-monospace text-dark">${displayLat}</td>
                <td class="fw-bold font-monospace text-dark">${displayLon}</td>
                <td>
                    <a href="${mapsLink}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                        <i class="fas fa-external-link-alt me-1"></i> Map
                    </a>
                </td>
            `;
            tbody.appendChild(tr);
        }

        tbody.dataset.raw = rawData;
        $('coords-output-card').classList.remove('d-none');
        $('coords-output-card').scrollIntoView({ behavior: 'smooth' });
    });

    $('copy-coords').addEventListener('click', function() {
        const data = $('coords-table-body').dataset.raw;
        navigator.clipboard.writeText(data).then(() => {
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-1"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });
});
</script>

