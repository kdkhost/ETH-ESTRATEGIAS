$viewsDir = "g:\Tudo\MEU-SISTEMA\ETH ESTRATEGIAS\resources\views"
$files = Get-ChildItem -Path $viewsDir -Filter "*-index.blade.php" -Recurse

foreach ($file in $files) {
    $content = Get-Content -Path $file.FullName -Raw
    
    # Check if file has an outer form with delete action
    if ($content -match '<form[^>]+action="\{\{route\(''delete\.[^'']+''\)\}\}"[^>]+id="([^"]+)"') {
        $formId = $matches[1]
        
        # 1. Close the outer form early (after the bulk action div)
        # Search for: <div class="d-flex align-items-center mb-4"> ... </div> (including inner content)
        # We'll just replace the start of the table responsive div
        $content = $content -replace '<div class="table-responsive">', "</form>`n                <div class=`"table-responsive`">"
        
        # 2. Remove the old closing </form> which is usually right after </div> <!-- table-responsive -->
        # We'll replace </table>\s*</div>\s*</form> with </table></div>
        $content = $content -replace '</table>\s*</div>\s*</form>', "</table>`n                </div>"
        
        # 3. Add form="$formId" to checkboxes
        $content = $content -replace 'class="checkboxes form-check-input"', "class=`"checkboxes form-check-input`" form=`"$formId`""
        
        Set-Content -Path $file.FullName -Value $content
        Write-Host "Corrigido: $($file.Name)"
    }
}
