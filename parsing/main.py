import asyncio
from playwright.async_api import async_playwright
from database import link

async def main():
    async with async_playwright() as p:
        browser = await p.chromium.launch()
        page = await browser.new_page()
        await page.goto(link.url)
        print(await page.title())
        await browser.close()

asyncio.run(main())
