$ErrorActionPreference = 'Stop'

$uploads = Join-Path $PSScriptRoot '..\uploads'
if (-not (Test-Path $uploads)) {
    New-Item -ItemType Directory -Path $uploads | Out-Null
}

$items = @(
    @{ File = 'bmw-3-series-g20.jpg'; Url = 'https://upload.wikimedia.org/wikipedia/commons/2/29/BMW_3_Series_%28G20%29.jpg' },
    @{ File = 'bmw-x5.jpg'; Url = 'https://upload.wikimedia.org/wikipedia/commons/2/23/BMW_X5_%284717067992%29.jpg' },
    @{ File = 'mercedes-c-class-w205.jpg'; Url = 'https://upload.wikimedia.org/wikipedia/commons/f/fe/Mercedes-Benz_C-Class_%28W205%29_%2816133461288%29.jpg' },
    @{ File = 'audi-a4.jpg'; Url = 'https://upload.wikimedia.org/wikipedia/commons/a/a0/Audi_A4.jpg' },
    @{ File = 'vw-golf-v-gti.jpg'; Url = 'https://upload.wikimedia.org/wikipedia/commons/9/98/VW_Golf_V_GTI.JPG' },
    @{ File = 'toyota-gr-yaris.jpg'; Url = 'https://upload.wikimedia.org/wikipedia/commons/8/87/Toyota_GR_Yaris.jpg' },
    @{ File = 'renault-megane-e-tech.jpg'; Url = 'https://upload.wikimedia.org/wikipedia/commons/c/c5/Renault_Megane_E_Tech.jpg' },
    @{ File = 'peugeot-e-2008.jpg'; Url = 'https://live.staticflickr.com/65535/53206950697_a8deabbcca_o.jpg' },
    @{ File = 'ford-mustang-mach-e.jpg'; Url = 'https://upload.wikimedia.org/wikipedia/commons/2/2e/Ford_Mustang_Mach-E_%2851134527887%29.jpg' },
    @{ File = 'volkswagen-t-roc.jpg'; Url = 'https://upload.wikimedia.org/wikipedia/commons/9/91/Volkswagen_T-Roc.jpg' }
)

foreach ($item in $items) {
    $dest = Join-Path $uploads $item.File
    Write-Host "Downloading $($item.File)"
    & curl.exe -L -A "Mozilla/5.0" -o $dest $item.Url
    if ($LASTEXITCODE -ne 0) {
        throw "Falha ao descarregar $($item.Url)"
    }
}

Write-Host 'OK'
